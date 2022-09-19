<template>
    <div>
    <section
        class="breadcrumb-main pb-20 pt-14"
        v-bind:style="{
        backgroundImage: 'url(/storage/city/' + _kes.banner + ')',
        }"
    >
        <div
        class="section-shape section-shape1 top-inherit bottom-0"
        style="background-image: url(/jpn_eb/images/shape8.png)"
        ></div>
        <div class="breadcrumb-outer">
        <div class="container">
            <div class="breadcrumb-content text-center">
            <h1 class="mb-3" :title="_kes.name" v-if="_kes.name.length > 17">
                {{ _kes.name | liveSubstr }}
            </h1>
            <h1 class="mb-3" :title="_kes.name" v-if="_kes.name.length < 17">
                {{ _kes.name }}
            </h1>
            </div>
        </div>
        </div>
        <div class="dot-overlay"></div>
    </section>
    
    <section class="trending pt-6 pb-0 bg-lgrey">
        <div class="container">
        <div class="row">
            <div class="col-lg-8">
            <div class="single-content">
                <div id="highlight" class="mb-4">
                <div class="description mb-2">
                    <h4>{{ _kes.name }}</h4>
                    <div class="rating-main d-flex align-items-center">
                        <p class="mb-0 me-2"><i class="icon-weather">

                        </i> <span style="font-size: .7rem;
                        font-weight: 600;">Current Weather:</span>
                        <span style="font-size: .7rem;
                        font-weight: 600;">{{(curr_weather.main.temp-273.15).toFixed(2)}}°C, 
                        {{curr_weather.weather[0]['description']}}, Wind S {{curr_weather.wind.speed}}km/h, {{curr_weather.main.humidity}}% Humidity
                        </span>
                        </p>
                        
                        </div>
                    <p class="mt-2">{{ _kes.description }}</p>
                </div>
                </div>
            </div>
            </div>
    
            <div class="col-lg-4">
            <div class="sidebar-sticky">
                <div class="list-sidebar">
                <div class="sidebar-item mb-4">
                    <h4 class="">Plan Your Trip</h4>
                    <ul class="sidebar-category">
                    <li v-for="x in _plan" :key="x.id">
                        <a :href="'/plan/' + x.id">{{ x.name }}</a>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
    <section class="trending pb-0 pt-6" v-if="_kes.todo.length">
        <div class="container">
        <div class="section-title mb-6 w-50 mx-auto text-center">
            <h4 class="mb-1 theme1">Top Destinations</h4>
            <h2 class="mb-1">
            Explore <span class="theme">Top Destinations</span>
            </h2>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4" v-for="x in _kes.todo" :key="x.id">
                <a :href="'/to-do/' + x.id">
                <div class="trend-item1">
                    <div class="trend-image position-relative rounded">
                    <img :src="'/storage/todo/' + x.banner" alt="" />
            
                    <div
                        class="
                        trend-content
                        d-flex
                        align-items-center
                        justify-content-between
                        position-absolute
                        bottom-0
                        p-4
                        w-100
                        z-index
                        "
                    >
                        <div class="trend-content-title">
                        <h5 class="mb-0">
                            <a :href="'/to-do/' + x.id" class="theme1">{{x.city.name}}</a>
                        </h5>
                        <h5 class="mb-0 white">{{x.name}}</h5>
                        </div>
                    
                    </div>
                    <div class="color-overlay"></div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        </div>
    </section>
    </div>
    </template>
    
    <script>
    import axios from "axios";
    export default {
        data() {
        return {
            curr_weather:"",
            next_weather:"",
        };
    },
    props: ["_kes", "_plan", "_cat"],
    created() {
    this.loadCurrWeather();
    this.loadWeatherNext();
    },
    filters: {
    liveSubstr: function (string) {
        return string.substring(0, 17) + "...";
    },
    },
    methods: {
        async loadCurrWeather() {
            let res = await axios.get("https://api.openweathermap.org/data/2.5/weather/", {
            params: { lat:this._kes.latitude, lon:this._kes.longitude, appid:'80030d8bb5eb51913cf630a09a8070a9' },
            });
            this.curr_weather = res.data;
        },

        async loadWeatherNext() {
            let res = await axios.get("https://api.openweathermap.org/data/2.5/forecast/", {
            params: { lat:this._kes.latitude, lon:this._kes.longitude, appid:'80030d8bb5eb51913cf630a09a8070a9' },
            });
            this.next_weather = res.data.list;
            console.log(this.next_weather);
        },
    }
    };
    </script>