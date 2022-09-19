<template>
<div>
<section
    class="breadcrumb-main pb-20 pt-14"
    v-bind:style="{
    backgroundImage: 'url(/storage/category/' + _kes.banner + ')',
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
            <div class="description-images mb-4">
                <!-- v-bind:style="{ backgroundImage: 'url(/storage/guide/' +_kes.banner + ')' }" -->
                <img
                :src="'/storage/category/' + _kes.add_banner"
                alt=""
                class="w-100 rounded"
                v-if="_kes.add_banner"
                />
            </div>
            <div class="description mb-2">
                <h4>{{ _kes.name }}</h4>
                <p>{{ _kes.description }}</p>
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
export default {
props: ["_kes", "_plan", "_cat"],
created() {
console.log(this._kes);
},
filters: {
liveSubstr: function (string) {
    return string.substring(0, 17) + "...";
},
},
};
</script>