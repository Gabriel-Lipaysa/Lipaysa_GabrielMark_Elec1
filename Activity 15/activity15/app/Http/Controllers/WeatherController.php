<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather($city1 = null, $city2 = null, $city3 = null)
    {
        $cities = [
            $city1 ?? 'London',
            $city2 ?? 'London',
            $city3 ?? 'London'
        ];
        $apiKey = env('OPENWEATHER_API_KEY');
        $weatherData = [];


        foreach ($cities as $city) {
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'metric'
            ]);
            
            if($response->successful()){
                $weatherData[] = [
                'city' => $city,
                'temperature' => $response['main']['temp'],
                'description' => $response['weather'][0]['description'],
                'humidity' => $response['main']['humidity'],
            ];
            } else {
                 $weatherData[] = [
                    'city' => $city,
                    'error' => 'Could not fetch weather data.'
                ];
            }
        }
        return view('weather', ['weatherData' => $weatherData]);

    }
}
