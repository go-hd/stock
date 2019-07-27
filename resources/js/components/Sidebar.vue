<template>
    <div class="sidebar bg-dark text-light d-flex flex-column">
        <slot></slot>
        <div class="content overflow-auto">
            <div class="list border-secondary border-bottom container-fluid py-2">
                <div class="title pt-2">{{ __('Storages') }}</div>
                <div v-for="storage in storages" class="item py-1 my-1">
                    <a class="text-light" :href="storage.url">{{ storage.name }}</a>
                    <ul class="list-unstyled mt-2">
                        <li class="product d-flex align-items-center justify-content-right" v-for="product in storage.products">
                            <div class="name"><span class="pr-2">-</span>{{ product.code }}</div>
                            <div
                                class="badge"
                                :class="['badge-' + productStatus(product)]"
                            >{{ product.stocks }}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import __ from '../helpers/lang'

export default {
    name: 'Sidebar',

    props: {
        storages: {
            type: Array,
            required: true
        },
    },

    methods: {
        productStatus(product) {
            return product.stocks > 500 ? 'success' :
                product.stocks > 100 ? 'light' :
                product.stocks > 10 ? 'warning' :
                'danger'
        },
        __
    }
}
</script>

<style lang="scss" scoped>
.sidebar {
    max-height: 100vh;
    background-color: #151B26;

    > .content {
        .list {
            > .title {
                color: #646f79 !important;
                font-size: 0.9em;
            }

            .name {
                flex: 1 1 auto;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .badge {
                min-width: 3em;
            }
        }
    }
}

</style>
