<?php

use App\Models\Category;
use App\Models\Client;
use App\Models\Item;
use App\Models\Unit;
use App\Models\Vendor;
use App\Models\Bank;

if (!function_exists('onGetCategory')) {
    function onGetCategory($category)
    {
        $data = Category::orderBy('created_at', 'DESC')->get(); 
        foreach ($data as $data) {
            if ($data->id == $category) { 
                echo "<option value='" . $data->id . "' selected>" . $data->name . "</option>";
            } else {
                echo "<option value='" . $data->id . "'>" . $data->name . "</option>"; 
            } 
        }
    }
}

if (!function_exists('onGetUnit')) {
    function onGetUnit($unit)
    {
        $data = Unit::orderBy('created_at', 'DESC')->get(); 
        foreach ($data as  $data) {
            if ($data->id == $unit) { 
                echo "<option value='" . $data->id . "' selected>" . $data->name . "</option>";
            } else {
                echo "<option value='" . $data->id . "'>" . $data->name . "</option>"; 
            } 
        }
    }
}

if (!function_exists('getPaymentMode')) {
    function getPaymentMode($method)
    {
        $data = array(
            'Cash' => 'Cash',
            'Online' => 'Online',
        );  
        foreach($data as $key => $val) { 
            if ($method == $key) {  
                echo "<option value='" . $key . "' selected>" . $val . "</option>";
            } else {
                echo "<option value='" . $key . "'>" . $val . "</option>";
            }         
        }     
    }
}

if (!function_exists('getPaymentStatus')) {
    function getPaymentStatus($method)
    {
        $data = array(
            'Paid' => 'Paid',
            'Unpaid' => 'Unpaid', 
        );  
        foreach($data as $key => $val) { 
            if ($method == $key) {  
                echo "<option value='" . $key . "' selected>" . $val . "</option>";
            } else {
                echo "<option value='" . $key . "'>" . $val . "</option>";
            }         
        }     
    }
}
if (!function_exists('getSellPayment')) {
    function getSellPayment($method)
    {
        $data = array(
            'Paid' => 'Paid',
            'Unpaid' => 'Unpaid', 
            'Advance' => 'Advance', 
        );  
        foreach($data as $key => $val) { 
            if ($method == $key) {  
                echo "<option value='" . $key . "' selected>" . $val . "</option>";
            } else {
                echo "<option value='" . $key . "'>" . $val . "</option>";
            }         
        }     
    }
}

if (!function_exists('getItems')) {
    function getItems($method)
    {
        $data = Item::all(); 
        foreach($data as $val) { 
            if ($method ==$val->id ) {  
                echo "<option value='" . $val->id . "' selected>" . $val->name . "</option>";
            } else {
                echo "<option value='" . $val->id . "'>" . $val->name . "</option>";
            }         
        }     
    }
}

if (!function_exists('getClient')) {
    function getClient($method)
    {
        $data = Client::all(); 
        foreach($data as $val) { 
            if ($method ==$val->id ) {  
                echo "<option value='" . $val->id . "' selected>" . $val->name . "</option>";
            } else {
                echo "<option value='" . $val->id . "'>" . $val->name . "</option>";
            }         
        }     
    }
}

if (!function_exists('getVendor')) {
    function getVendor($method)
    {
        $data = Vendor::all(); 
        foreach($data as $val) { 
            if ($method ==$val->id ) {  
                echo "<option value='" . $val->id . "' selected>" . $val->name . "</option>";
            } else {
                echo "<option value='" . $val->id . "'>" . $val->name . "</option>";
            }         
        }     
    }
}

if (!function_exists('onGetBank')) {
    function onGetBank($bank)
    {
        $data = Bank::orderBy('created_at', 'DESC')->get(); 
        foreach ($data as $data) {
            if ($data->id == $bank) { 
                echo "<option value='" . $data->id . "' selected>" . $data->name . "</option>";
            } else {
                echo "<option value='" . $data->id . "'>" . $data->name . "</option>"; 
            } 
        }
    }
}