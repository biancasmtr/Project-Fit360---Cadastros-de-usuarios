<template>
    <div>
        <span v-if="item">
            <button
                v-on:click="preencheForm()"
                v-if="!tipo || (tipo != 'button' && tipo != 'link')"
                type="button"
                :class="css || 'btn btn-primary'" data-toggle="modal"
                :data-target="'#' + nome">{{titulo}}
            </button>

            <button
                v-on:click="preencheForm()"
                v-if="tipo == 'button'" type="button"
                :class="css || 'btn btn-primary'"
                data-toggle="modal"
                :data-target="'#' + nome">{{titulo}}
            </button>

            <a
            class="btn btn-outline-primary"
                v-on:click="preencheForm()"
                v-if="tipo == 'link'" href="#"
                :class="css"
                data-toggle="modal"
                :data-target="'#' + nome">
                    <slot ></slot>
            </a>
        </span>
    </div>
</template>

<script>
export default {
    props: ['tipo','nome','titulo','css','item','url'],
    methods: {
        preencheForm: function(item) {
            if (this.item.id) {
               axios.get(this.url + this.item.id).then(res => {
                this.$store.commit('setItem',res.data);
            }); 
            } else {
                this.$store.commit('setItem',this.item);
                } 
            }
            //this.$store.commit('setItem',this.item);
        },

    }

</script>
