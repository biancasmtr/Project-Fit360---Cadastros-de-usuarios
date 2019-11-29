<template>
    <div class="small-box" :style="defineCor">
        <div class="inner">
            <h3>{{titulo}}</h3>
            <p>{{qtd}}</p>
        </div>
        <div class="icon">
            <i v-bind:class="icone"></i>
        </div>
        <a :href="url" class="small-box-footer">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</template>

<script>
export default {
    props: ['qtd','titulo','url','cor','icone'],
    computed: {
        defineCor() {
            return "background-color: "+this.cor+" !Important;"
        }
    }
}
</script>

<style scoped>


.small-box {
    width: 40%;
    margin-left: 1%;
    border-radius: 2px;
    position: relative;
    display: block;
    float: left;
    margin-right: 10px;
    margin-bottom: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}

.small-box>.inner {
    padding: 10px;
}

div {
    display: block;
}

.small-box h3, .small-box p {
    z-index: 5;
}

.small-box h3 {
    font-size: 38px;
    font-weight: bold;
    margin: 0 0 10px 0;
    white-space: nowrap;
    padding: 0;
    color: #fff;
}

.small-box h3, .small-box p {
    z-index: 5;
}

p {
    margin: 0 0 10px;
    color: #fff;
}

.small-box p {
    font-size: 15px;
}

.small-box .icon {
    -webkit-transition: all .3s linear;
    -o-transition: all .3s linear;
    transition: all .3s linear;
    position: absolute;
    top: -10px;
    right: 10px;
    z-index: 0;
    font-size: 90px;
    color: rgba(0,0,0,0.15);
}

.small-box>.small-box-footer {
    position: relative;
    text-align: center;
    padding: 3px 0;
    color: #fff;
    color: rgba(255,255,255,0.8);
    display: block;
    z-index: 10;
    background: rgba(0,0,0,0.1);
    text-decoration: none;
}

.small-box>.small-box-footer:hover {
    color: #fff;
    background: rgba(0,0,0,0.15);
}

.ion {
    display: inline-block;
    font-family: "Ionicons";
    font-style: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    text-rendering: auto;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
}

.small-box:hover {
    text-decoration: none;
}

.small-box:hover .icon {
    font-size: 95px;
}

.ion-bag:before {
    content: "\f110";
}

</style>
