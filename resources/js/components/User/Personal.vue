<template>
    <div>
        Personal

        <div class="mb-3">
            <h4 class="text-dark">Добавить изображение к пользователя</h4>
            <input v-on:change="onFileSelected" class="form-control w-75" type="file" id="formFile">
        </div>
        <a href="#" class="btn btn-success mb-5" @click.prevent="addPhoto">Добавить</a><br>
        <a href="#" class="btn btn-success mb-5" @click.prevent="getQuests">Получить список всех доступных квестов</a><br>
        <a href="#" class="btn btn-success mb-5" @click.prevent="getAllQuests">Получить список всех квестов (админ)</a><br>
        <a href="#" class="btn btn-success mb-5" @click.prevent="getUser">Получить Данные о пользователе</a><br>

        <a href="#" class="btn btn-success mb-5" @click.prevent="hideQuest">Скрыть квест</a><br>

        <div class="mb-3">
            <h4 class="text-dark">Добавить стандартное изображение в профиль</h4>
            <input v-on:change="onFileSelected" class="form-control w-75" type="file" id="formFile">
        </div>
        <a href="#" class="btn btn-success mb-5" @click.prevent="addDefaultPhoto">Добавить</a><br>

        <input v-model="defaultPhoto" type="email" class="form-control mb-3" placeholder="Название файла">
        <a href="#" class="btn btn-success mb-5" @click.prevent="chooseDefaultPhoto">Добавить</a><br>

        <input v-model="defaultPhotoUser" type="email" class="form-control mb-3" placeholder="айди пользователя">
        <a href="#" class="btn btn-success mb-5" @click.prevent="deletePhoto">Удалить аву</a><br>
        <a href="#" class="btn btn-success mb-5" @click.prevent="showPhoto">Все загруженные пользователями фото</a><br>



        <input v-model="news" type="email" class="form-control mb-3" placeholder="контент новости">
        <div class="mb-3">
            <h4 class="text-dark">Добавить стандартное изображение новости</h4>
            <input v-on:change="onFileSelected" class="form-control w-75" type="file" id="formFile">
        </div>
        <a href="#" class="btn btn-success mb-5" @click.prevent="addNews">Добавить</a><br>
        <a href="#" class="btn btn-success mb-5" @click.prevent="Check">test</a><br>
    </div>
</template>

<script>
import api from "../../api.js"
export default {
    data() {
        return {
            photo: null,
            quests:null,
            defaultPhoto:null,
            defaultPhotoUser:null,
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
                    console.log(res);
                })
        },
        addDefaultPhoto() {
            // let formData = new FormData();
            // formData.append('file', this.photo);
            api.get('/api/auth/admin/pictures/')
                .then(res => {
                    console.log(res);
                })
        },
        chooseDefaultPhoto() {
            // let formData = new FormData();
            // formData.append('file', this.photo);
            api.post('/api/auth/users/photo/choose', {photo: this.defaultPhoto})
                .then(res => {
                    console.log(res);
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
        getAllQuests() {
            api.get('/api/auth/admin/quests')
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
        hideQuest() {
            api.get('/api/auth/admin/quests/hide/6')
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err.response);
                })
        },
        showPhoto(){
            api.get('/api/auth/admin/photos')
                .then(res => {
                    this.quests = res.data.data
                    console.log(this.quests);
                })
                .catch(err => {
                    console.log(err.response);
                })
        },
        deletePhoto(){
            api.delete(`/api/auth/admin/photos/${this.defaultPhotoUser}`)
                .then(res => {
                    this.quests = res.data
                    console.log(this.quests);
                })
                .catch(err => {
                    console.log(err.response);
                })
        },

        addNews() {

            const formData = new FormData();
            formData.append(`content`, JSON.stringify(this.news));
            formData.append(`file`, this.photo);
            api.post('/api/auth/news', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(res => {
                console.log(res);
            })
                .catch(err => {
                    console.log(err.response);
                })

        },
        Check() {
            // let formData = new FormData();
            // formData.append('file', this.photo);
            const data = {
                "content": {
                    "title_start": "Заголовок"
                }
            }

            api.patch('/api/auth/quests/1', data)
                .then(res => {
                    console.log(res);
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
