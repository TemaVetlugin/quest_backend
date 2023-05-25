<template>
    <div>
        <input v-model="teamTitle" type="text" class="form-control mt-3 mb-3" placeholder="Название команды">
        <a href="#" class="btn btn-success mb-5" @click.prevent="addTeam">Создать команду</a>
        <input v-model="teamKey" type="text" class="form-control mt-3 mb-3" placeholder="Ключ команды">
        <a href="#" class="btn btn-success mb-5" @click.prevent="joinTeam">Присоединиться</a>
        <input v-model="teamId" type="text" class="form-control mt-3 mb-3" placeholder="id команды">
        <a href="#" class="d-block btn btn-success mb-5 w-25" @click.prevent="isAdmin">Являюсь админом</a>
        <input v-model="userId" type="text" class="form-control mt-3 mb-3" placeholder="id участника">
        <a href="#" class="d-block btn btn-success mb-5 w-25" @click.prevent="deleteUser">Удалить участника команды</a>
        <input v-model="newUserId" type="text" class="form-control mt-3 mb-3" placeholder="id участника">
        <a href="#" class="d-block btn btn-success mb-5 w-25" @click.prevent="changeUser">Добавить участника</a>
        <input v-model="team" type="text" class="form-control mt-3 mb-3" placeholder="id команды">
        <a href="#" class="d-block btn btn-success mb-5 w-25" @click.prevent="getTeam">Данные команды</a>
        <a href="#" class="d-block btn btn-danger mb-5 w-25" @click.prevent="quitTeam">Выйти из команды </a>
    </div>
</template>

<script>
import api from "../../api.js"

export default {
    data() {
        return {
            fruits: null,
            api: null,
            users: null,
            teamTitle: null,
            teamKey: null,
            teamId: null,
            team: null,
            userId: null,
            newUserId: null,
        }
    },


    methods: {

        addTeam() {
            api.post('/api/auth/teams', {title:this.teamTitle})
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                })
        },
        joinTeam() {
            api.post('/api/auth/teams/join', {key:this.teamKey})
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                })
        },
        quitTeam() {
            api.get('/api/auth/teams/quit')
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                })
        },
        isAdmin() {
            api.get(`/api/auth/teams/admin/${this.teamId}`)
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                })
        },
        deleteUser() {
            api.post(`/api/auth/teams/quit`, {userId: this.userId})
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                })
        },
        changeUser() {
            api.post(`/api/auth/teams/add`, {userId: this.newUserId})
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                })
        },
        getTeam() {
            api.get(`/api/auth/teams/${this.team}`)
                .then(res => {
                    console.log(res);
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
