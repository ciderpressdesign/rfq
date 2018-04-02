<template>
    <div>
        <section class="section">
            <div class="hero is-primary">
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title">Request For Quote</h1>
                        <h2 class="subtitle">Fill and Save</h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column is-one-fifth">
                        <ComponentList @add-component="addComponent"/>
                    </div>

                    <!-- Selected Game Components -->

                    <div class="column is-one-fifth">
                        <nav class="panel">
                            <p class="panel-heading">Selected Components</p>
                            <router-link
                                    class="panel-block"
                                    active-class="is-active"
                                    to="/info">
                                Game Info
                            </router-link>
                            <router-link
                                    active-class="is-active"
                                    :to="'/' + component.component_type.form+ '/' + component.id"
                                    :key="component.id"
                                    v-for="(component,index) in selectedComponents"
                                    class="panel-block">
                            <span class="panel-icon" @click.stop.prevent.once="removeComponent(component.id)">
                                <i class="fa fa-minus"></i>
                            </span>
                                <span class="panel-icon">
                                <i :class="['fa',component.component_type.icon]"></i>
                            </span>
                                {{ component.component_type.name }}
                            </router-link>
                        </nav>

                    </div>
                    <div class="column is-three-fifths">
                        <div class="box">
                            <router-view/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import axios from 'axios'
    import ComponentList from "./ComponentList";
    // axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
export default {
  name: 'RequestQuote',
    components: {ComponentList},
    data () {
    return {
      gameId: 1,
      nextID: 0,
      selectedComponents: []
    }
  },
  methods: {
    addComponent (gamecomponent) {
      axios({
        method: 'post',
        url: '/api/component',
        params: {
          game_id: this.gameId,
          component_type_id: gamecomponent.id
        }
      }).then(response => {
        this.selectedComponents.push(response.data)
      }).catch(error => console.log('failed writing component))'))
    },
    removeComponent (id) {
      axios({
        method: 'delete',
        url: '/api/component',
        params: {id: id}
      }).then(response => {
        var deletedComponent = this.selectedComponents.findIndex( function(component) {
            return component.id == id
        },this)
        this.selectedComponents.splice(deletedComponent, 1)
      })
        .catch(error => console.log(error))
    }
  },
  created () {
    axios.get('/api/component').then(response => {
      this.selectedComponents = response.data
    }).catch(error => console.log('failed getting components'))
  }
}

</script>

<style scoped>
    .panel-block.is-active {
        background: #F6C6CE;
    }
</style>
