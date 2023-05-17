<template>
  <div>
     <div class="w-25">

    <input v-model="name" type="name" class="form-control mt-3 mb-3" placeholder="name">
    <input v-model="email" type="email" class="form-control mb-3" placeholder="email">
    <input v-model="password" type="password" class="form-control mb-3" placeholder="password">
    <input v-model="password_confirmation" type="password" class="form-control mb-3" placeholder="confirm password">
    <input type="submit" @click.prevent="store" class="btn btn-primary mb-3" value="send" >
  </div>
  </div>
</template>

<script>
export default {

  data(){
    return{
    name: '',
    email:'',
    password:'',
    password_confirmation:''
    }
  },

  mounted() {

  },

  methods: {
    store(){
      axios.post('/api/auth/users', {name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirmation, scores: 0})
      .then(res=>{
        localStorage.setItem('access_token', res.data.access_token)
        this.$router.push({name: 'user.personal'})
        // console.log(res);
      })
          .catch(err=>{
              // console.log(err);
          })
    }
  }

}
</script>

<style>

</style>
