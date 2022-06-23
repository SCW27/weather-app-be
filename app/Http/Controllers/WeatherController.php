<?php

namespace App\Http\Controllers;

use App\Http\Requests\Weather\GetPlaceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Service\OpenWeatherServiceInterface;

class WeatherController extends Controller
{

    private OpenWeatherServiceInterface $openWeatherService;

    public function __construct(
        OpenWeatherServiceInterface $openWeatherService
    ) {
        $this->openWeatherService = $openWeatherService;
    }

    public function getWeather(Request $request)
    {
        // api.openweathermap.org/data/2.5/forecast?lat={lat}&lon={lon}&appid={API key}
        $baseKey = env('WEATHER_API_KEY');
        $baseUrl = env('WEATHER_API_BASE_URL') . '/data/2.5/forecast?lat=' . $request->lat . '&lon=' . $request->lon . '&appid=' . $baseKey . "&cnt=5&units=metric";

        $response = Http::get($baseUrl);
        return response()->json([
            'data' => $response->json()
        ], 200);
    }

    public function getPlace(Request $request)
    {
        $baseKey = env('WEATHER_API_KEY');
        $baseUrl = env('WEATHER_API_BASE_URL') . '/geo/1.0/direct?q=' . $request->place . '&limit=5&appid=' . $baseKey;

        $response = Http::get($baseUrl);
        return response()->json([
            'data' => $response->json()
        ], 200);
    }

    public function getPlaceDetails(GetPlaceRequest $request)
    {

        $baseKey = env('GEOCODE_API_KEY');
        $baseUrl = env('GEOCODE_API_BASE_URL') . '/v1/geocode/reverse?lat=' . $request->lat . '&lon=' . $request->lon . '&format=json&apiKey=' . $baseKey;


        $response = Http::get($baseUrl);
        return response()->json([
            'data' => $response->json()
        ], 200);
    }
}
