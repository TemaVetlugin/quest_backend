<template>
  <div>
    <router-link v-if="this.access_token" :to="{name: 'fruit.index'}">Users  </router-link>
    <router-link v-if="this.access_token" :to="{name: 'team.index'}">Teams  </router-link>
    <router-link v-if="this.access_token" :to="{name: 'quest.index'}">Quests  </router-link>
    <router-link v-if="this.access_token" :to="{name: 'quest.start'}">Start  </router-link>
    <router-link v-if="!this.access_token" :to="{name: 'user.login'}">Login  </router-link>
    <router-link v-if="!this.access_token" :to="{name: 'user.registration'}">Registration  </router-link>
    <router-link v-if="this.access_token" :to="{name: 'user.personal'}">Personal  </router-link>
    <a v-if="this.access_token" href="#" @click.prevent="logout"> Logout</a>
    <router-view :key="$route.fullPath" ></router-view>
  </div>
</template>

<script>
import api from '../api'
export default {

  data(){
    return {
      access_token: null
    }
  },

  mounted(){
    this.getAccessToken()
  },

  updated(){
    this.getAccessToken()
  },

  methods:{

    getAccessToken(){
        this.access_token=localStorage.getItem('access_token')
        // console.log(this.access_token);
    },

    logout(){
      api.post('/api/auth/logout')
      .then(res=>{
        localStorage.removeItem('access_token')
        this.$router.push({name: 'user.login'})
      })
    }
  }

}
</script>

<style>

</style>
