<template>
    <nav class="panel">
        <p class="panel-heading">All Components</p>
        <div class="panel-block">
            <p class="control has-icons-left">
                <input @keyup="filterAvailableComponents" v-model="filterString"
                       class="input is-small" type="text" placeholder="search">
                <span class="icon is-small is-left">
                                        <i class="fas fa-search"></i>
                                    </span>
            </p>
        </div>
        <p class="panel-tabs">
            <a v-for="category in categories"
               :class="{'is-active' : category === currentCategory }"
               @click="currentCategory = category; filterString = ''">
                {{ category }}
            </a>
        </p>
        <a v-for="component in availableComponentsShowing" class="panel-block">
                            <span class="panel-icon" @click="$emit('add-component',component)">
                                <i class="fa fa-plus"></i>
                            </span>
            <span class="panel-icon">
                                <i :class="['fa',component.icon]"></i>
                            </span>
            {{ component.name }}
        </a>
    </nav>
</template>
<script>
    import axios from 'axios'
    export default {
        name: 'ComponentList',
        data: function() {
            return {
                filterString: '',
                availableComponents: [],
                categories: [
                    'all',
                    'pieces',
                    'cards',
                    'boxes'
                ],
                currentCategory: 'all',
            }

        },
        computed: {
            availableComponentsShowing () {
                if (this.currentCategory === 'all') {
                    if (this.filterString.length) {
                        return this.availableComponents.filter(function (component) {
                            return component.name.includes(this.filterString)
                        }, this)
                    }
                    return this.availableComponents
                } else {
                    return this.availableComponents.filter(function (component) {
                        return component.category === this.currentCategory
                    }, this)
                }
            }
        },
        methods: {
            filterAvailableComponents () {
                if (this.filterString.length) {
                    this.currentCategory = 'all'
                }
            },
        },
        created() {
            axios.get('/api/component-types').then(response => {
                this.availableComponents = response.data
                console.log(response.data)
            }).catch(error => console.log('failed reading components'))

        }
    }
</script>
