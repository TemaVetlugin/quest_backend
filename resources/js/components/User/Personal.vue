<template>
    <div>
        Personal

        <div class="mb-3">
            <h4 class="text-dark">Добавить изображение к пользователя</h4>
            <input v-on:change="onFileSelected" class="form-control w-75" type="file" id="formFile">
        </div>
        <a href="#" class="btn btn-success mb-5" @click.prevent="addPhoto">Добавить</a><br>
        <a href="#" class="btn btn-success mb-5" @click.prevent="getQuests">Получить список всех квестов</a><br>
        <a href="#" class="btn btn-success mb-5" @click.prevent="getUser">Получить Данные о пользователе</a><br>

    </div>
</template>

<script>
import api from "../../api.js"
export default {
    data() {
        return {
            photo: null,
            quests:null,
        }
    },
    methods: {
        addPhoto() {
            let formData = new FormData();
            formData.append('photo', this.photo);
            api.post('/api/auth/users/photo', formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(res => {
                })
        },
        getQuests() {
            axios.get('/api/auth/quests')
                .then(res => {
                    this.quests = res.data.data
                    console.log(this.quests);
                })
                .catch(err => {
                    console.log(err.response);
                })
        },

        getUser() {
            api.get('/api/auth/users')
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err.response);
                })
        },

        onFileSelected(event) {
            this.photo = event.target.files[0];
        },
    }
}
</script>

<style>

</style>
