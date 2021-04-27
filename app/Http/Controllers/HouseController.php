<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Room;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $houses = \App\Models\House::paginate(10);
        $filterKeyword = $request->get('keywoard');
        if ($filterKeyword) {
            $houses = \App\Models\House::where('name', 'LIKE', "%$filterKeyword%")->paginate(10);
        }
        return view('houses.index', ['houses' => $houses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('houses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_house = new \App\Models\House;
        $new_house->name = $request->get('name');
        $new_house->house_type = $request->get('house_type');
        $new_house->user_id = \Auth::user()->id;
        $new_house->created_by = \Auth::user()->id;
        $new_house->save();
        return redirect()->route('houses.create')->with('status', 'Data rumah berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $house = \App\Models\House::findOrFail($id);
        $rooms = Room::where('house_id', $id)->paginate(10);
        $filterKeyword = $request->get('keywoard');
        if ($filterKeyword) {
            // $products = \App\Models\Product::where('name', 'LIKE', "%$filterKeyword%")->paginate(10);
            $rooms = Room::where('house_id', $id)->where('name', 'LIKE', "%$filterKeyword%")->paginate(10);
        }

        return view('rooms.index', ['house' => $house, 'rooms' => $rooms]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $house_to_edit = \App\Models\House::findOrFail($id);
        return view('houses.edit', ['house' => $house_to_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->get('name');
        $house_type = $request->get('house_type');
        $house = \App\Models\House::findOrFail($id);

        $house->name = $name;
        $house->house_type = $house_type;
        $house->updated_by = \Auth::user()->id;
        $house->save();
        return redirect()->route('houses.edit', [$id])->with('status', 'Rumah berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $house = \App\Models\House::findOrFail($id);
        $house->forceDelete();
        return redirect()->route('houses.index')->with('status', 'Data rumah berhasil dihapus');
    }

    public function estimated_product($id)
    {
        $rooms = House::find($id)->rooms->toArray();
        $items = [];
        $ids = array_column($rooms, 'id');
        $long = array_column($rooms, 'long');
        $wide = array_column($rooms, 'wide');
        $height = array_column($rooms, 'height');
        $category = array_column($rooms, 'category_id');
        $area = $this->calculate_area($long, $wide);
        $light = $this->_light_points($area);
        $pipa = $this->_pipa($height, $category);
        $items = $this->_input_items('id', $ids, $items);
        $items = $this->_input_items('category_id', $category, $items);
        $items = $this->_input_items('long', $long, $items);
        $items = $this->_input_items('wide', $wide, $items);
        $items = $this->_input_items('height', $height, $items);
        $items = $this->_input_items('luas', $area, $items);
        $items = $this->_input_items('titik_lampu', $light, $items);
        $items = $this->_input_items('pipa', $pipa, $items);
        $items = $this->_item_from_category($category, $items);
        $items = $this->_calculate_nym($items);
        $items = $this->_calculate_watt($items);

        $pips = ceil(array_sum(array_column($items, 'pipa')));
        $saklar_sk_tunggal = array_sum(array_column($items, 'saklar_sk_tunggal'));
        $saklar_ganda_sk_tunggal = array_sum(array_column($items, 'saklar_ganda_sk_tunggal'));
        $sk_tunggal = array_sum(array_column($items, 'sk_tunggal'));
        $saklar_tunggal_sk_ganda = array_sum(array_column($items, 'saklar_tunggal_sk_ganda'));
        $kabel_nya = array_sum(array_column($items, 'kabel_nya'));
        $kabel_nya_grounding = array_sum(array_column($items, 'kabel_nya_grounding'));
        $kabel_nym = array_sum(array_column($items, 'kabel_nym'));
        $watt_lampu = array_count_values($this->_olah_watt($items));

        // Buat array product
        $products = [];
        $products = $this->_input_product($products, 'saklar tunggal stop kontak tunggal', $saklar_sk_tunggal);
        $products = $this->_input_product($products, 'saklar ganda stop kontak tunggal', $saklar_ganda_sk_tunggal);
        $products = $this->_input_product($products, 'stop kontak tunggal', $sk_tunggal);
        $products = $this->_input_product($products, 'saklar tunggal stop kontak ganda', $saklar_tunggal_sk_ganda);
        $products = $this->_input_product($products, 'kabel nya', $kabel_nya);
        $products = $this->_input_product($products, 'kabel nya grounding', $kabel_nya_grounding);
        $products = $this->_input_product($products, 'kabel nym', $kabel_nym);
        $products = $this->_input_product($products, 'pipa', $pips);
        $products = $this->_input_watt($watt_lampu, $products);


        for ($i = 0; $i < sizeof($products); $i++) {
            $barang = Product::where('name', 'like', '%' . $products[$i]['name'] . '%')->get()->toArray();
            if ($barang != null) {
                $products[$i]['product_id'] = $barang[0]['id'];
            } else {
                $products[$i]['product_id'] = null;
            }
        }

        // Siapkan array pivot tabel
        $array_house_product = [];
        for ($i = 0; $i < sizeof($products); $i++) {
            $array_house_product[$i]['product_id'] = $products[$i]['product_id'];
            $array_house_product[$i]['qty'] = $products[$i]['qty'];
            $array_house_product[$i]['info'] = "";
        }


        // Simpan ke tabel pivot house_product
        $new_house = House::find($id);
        $new_house->products()->attach($array_house_product);


        var_dump('<pre>', $array_house_product, '</pre>');
        // var_dump('<pre>', array_keys($watt_lampu), '</pre>');
    }


    function calculate_area($long, $wide)
    {
        for ($i = 0; $i < sizeof($long); $i++) {
            $area[$i] = $long[$i] * $wide[$i];
        }
        return $area;
    }

    private function _input_product($product, $name, $value)
    {
        $product[sizeof($product)]['name'] = $name;
        $product[sizeof($product) - 1]['qty'] = $value;
        return $product;
    }

    private function _input_watt($watt_lampu, $products)
    {
        $akeys = array_keys($watt_lampu);
        foreach ($akeys as $a) {
            $products[sizeof($products)]['name'] = $a . ' watt';
            $products[sizeof($products) - 1]['qty'] = $watt_lampu[$a];
        }
        return $products;
    }

    private function _input_items($name, $value, $items)
    {
        for ($i = 0; $i < sizeof($value); $i++) {
            $items[$i][$name] = $value[$i];
        }
        return $items;
    }

    private function _light_points($area)
    {
        foreach ($area as $a) {
            if ($a > 9) {
                $light[] = 2;
            } else {
                $light[] = 1;
            }
        }
        return $light;
    }

    private function _pipa($height, $category)
    {
        for ($i = 0; $i < sizeof($height); $i++) {
            if ($category[$i] == 1) {
                $pipa[] = 0;
            } elseif ($category[$i] == 2 || $category[$i] == 3) {
                $pipa[] = ($height[$i] - 1.25) * 2;
            } else {
                $pipa[] = $height[$i] - 1.25;
            }
        }
        return $pipa;
    }

    private function _item_from_category($categories, $items)
    {
        for ($i = 0; $i < sizeof($categories); $i++) {
            if ($categories[$i] == 1) {
                $items[$i]["saklar_sk_tunggal"] = 0;
                $items[$i]["saklar_ganda_sk_tunggal"] = 0;
                $items[$i]["sk_tunggal"] = 0;
                $items[$i]["saklar_tunggal_sk_ganda"] = 0;
                $items[$i]["kabel_nya"] = 0;
                $items[$i]["kabel_nya_grounding"] = 0;
            } elseif ($categories[$i] == 2) {
                $items[$i]["saklar_sk_tunggal"] = 0;
                $items[$i]["saklar_ganda_sk_tunggal"] = 1;
                $items[$i]["sk_tunggal"] = 1;
                $items[$i]["saklar_tunggal_sk_ganda"] = 0;
                $items[$i]["kabel_nya"] = 6 * ($items[$i]['height'] - 1.25);
                $items[$i]["kabel_nya_grounding"] = 2 * ($items[$i]['height'] - 1.25);
            } elseif ($categories[$i] == 3) {
                $items[$i]["saklar_sk_tunggal"] = 1;
                $items[$i]["saklar_ganda_sk_tunggal"] = 0;
                $items[$i]["sk_tunggal"] = 1;
                $items[$i]["saklar_tunggal_sk_ganda"] = 0;
                $items[$i]["kabel_nya"] = 5 * ($items[$i]['height'] - 1.25);
                $items[$i]["kabel_nya_grounding"] = 2 * ($items[$i]['height'] - 1.25);
            } elseif ($categories[$i] == 4) {
                $items[$i]["saklar_sk_tunggal"] = 0;
                $items[$i]["saklar_ganda_sk_tunggal"] = 0;
                $items[$i]["sk_tunggal"] = 0;
                $items[$i]["saklar_tunggal_sk_ganda"] = 1;
                $items[$i]["kabel_nya"] = 4 * ($items[$i]['height'] - 1.25);
                $items[$i]["kabel_nya_grounding"] = 2 * ($items[$i]['height'] - 1.25);
            } elseif ($categories[$i] == 5) {
                $items[$i]["saklar_sk_tunggal"] = 0;
                $items[$i]["saklar_ganda_sk_tunggal"] = 0;
                $items[$i]["sk_tunggal"] = 0;
                $items[$i]["saklar_tunggal_sk_ganda"] = 0;
                $items[$i]["kabel_nya"] = 0;
                $items[$i]["kabel_nya_grounding"] = 0;
            } elseif ($categories[$i] == 6) {
                $items[$i]["saklar_sk_tunggal"] = 0;
                $items[$i]["saklar_ganda_sk_tunggal"] = 1;
                $items[$i]["sk_tunggal"] = 1;
                $items[$i]["saklar_tunggal_sk_ganda"] = 0;
                $items[$i]["kabel_nya"] = 6 * ($items[$i]['height'] - 1.25);
                $items[$i]["kabel_nya_grounding"] = 2 * ($items[$i]['height'] - 1.25);
            } elseif ($categories[$i] == 7) {
                $items[$i]["saklar_sk_tunggal"] = 0;
                $items[$i]["saklar_ganda_sk_tunggal"] = 1;
                $items[$i]["sk_tunggal"] = 1;
                $items[$i]["saklar_tunggal_sk_ganda"] = 0;
                $items[$i]["kabel_nya"] = 6 * ($items[$i]['height'] - 1.25);
                $items[$i]["kabel_nya_grounding"] = 2 * ($items[$i]['height'] - 1.25);
            }
        }
        return $items;
    }

    private function _calculate_nym($items)
    {
        for ($i = 0; $i < sizeof($items); $i++) {
            if ($items[$i]['luas'] > 9) {
                if ($items[$i]['long'] >= $items[$i]['wide']) {
                    $items[$i]['kabel_nym'] = ceil(($items[$i]['long'] / 3) * 2);
                } else {
                    $items[$i]['kabel_nym'] = ceil(($items[$i]['wide'] / 3) * 2);
                }
            } else {
                if ($items[$i]['long'] >= $items[$i]['wide']) {
                    $items[$i]['kabel_nym'] = ceil($items[$i]['long'] / 2);
                } else {
                    $items[$i]['kabel_nym'] = ceil($items[$i]['wide'] / 2);
                }
            }
        }
        return $items;
    }

    private function _calculate_watt($items)
    {
        $lux = null;
        for ($i = 0; $i < sizeof($items); $i++) {
            $category = Category::find($items[$i]["category_id"])->toArray();
            $lumen = ($category["lux"] * $items[$i]["luas"] * 0.6 * 0.8) / $items[$i]["titik_lampu"];
            $watt = $lumen / 75;
            if ($watt < 4) {
                $watt = 3;
            }
            $items[$i]['watt'] = (int)ceil($watt);
        }
        return $items;
    }

    private function _olah_watt($items)
    {
        $temp = [];
        for ($i = 0; $i < sizeof($items); $i++) {
            for ($j = 0; $j < $items[$i]['titik_lampu']; $j++) {
                array_push($temp, $items[$i]['watt']);
            }
        }
        return $temp;
    }
}
