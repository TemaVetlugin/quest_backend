<template>
  <div class="w-25">

    <input v-model="email" type="email" class="form-control mt-3 mb-3" placeholder="email">
    <input v-model="password" type="password" class="form-control mb-3" placeholder="password">
    <input @click.prevent="this.loginJwt" type="submit" class="btn btn-primary mb-3" value="send">
    <input @click.prevent="this.loginGoogle" type="submit" class="btn btn-primary mb-3" value="google">
    <input @click.prevent="this.loginGoogleTest" type="submit" class="btn btn-primary mb-3" value="googleeeee">

  </div>
</template>

<script>
export default {

data(){
  return{
    email: null,
    password: null,
      message: '',
  }
},

methods: {
loginJwt(){
  axios.post('/api/auth/login', {email: this.email, password: this.password})
  .then(res=>{
    localStorage.access_token=res.data.access_token

    this.$router.push({name:'fruit.index'})
  })
},
loginGoogle(){
    window.location.href = '/google'
},
loginGoogleTest(){
    var data={email: "s.fedoseev813@gmail.com",
        email_verified: true,
        family_name: "Fedoseev",
        given_name: "Sergey",
        locale: "ru",
        name: "Sergey Fedoseev",
        picture: "https://lh3.googleusercontent.com/a/AGNmyxbs9nbfUIDam3ltY1TC3i2NtPTQQFplYSjh1-CI=s96-c",
        sub: "105184527130561993514"}
    axios.post('/api/auth/google/login', data)
}
}

}
</script>

<style>

</style>
