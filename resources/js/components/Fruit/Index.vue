<template>
    <div class="mt-5">
        Users
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Scores</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users">
                <td>{{ user.name }}</td>
                <td>{{ user.scores }}</td>
            </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
import api from "../../api.js"

export default {
    data() {
        return {
            fruits: null,
            api: null,
            users: null

        }
    },

    mounted() {
        this.getUsers()
    },

    methods: {
        getUsers() {
            axios.get('/api/auth/users/leaders')
                .then(res => {
                    // console.log(response);
                    this.users = res.data.data
                })
                .catch(err => {
                    console.log(err);
                })
        },

    }
}
</script>

<style>

</style>
