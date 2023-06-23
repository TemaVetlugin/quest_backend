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
            // var jsonString = JSON.stringify(data);

            // const data = new FormData();
            const data={
                "tasks": [
                    {
                        "quest_id": 1,
                        "address": "TEXT",
                        "time": 30,
                        "title": "TEXT",
                        "text": "TEXT",
                        "hint1": "TEXT",
                        "hint2": "TEXT",
                        "hint3": "TEXT",
                        "hint1_time": 1,
                        "hint2_time": 5,
                        "hint3_time": 10,
                        "hint1_scores": 50,
                        "hint2_scores": 100,
                        "hint3_scores": 200,
                        "qr": 1,
                        "key": "GmCC",
                        "title_qr": "TEXT",
                        "address_qr": "TEXT",
                        "answer": 1,
                        "scores": 500,
                        "file": this.photo,
                        "file_qr": null
                    }
                ],
                "categories": [
                    {
                        "id": 53,
                        "task_id": 0,
                        "time": 10,
                        "scores": 10,
                        "created_at": "2023-06-23T10:13:57.000000Z",
                        "updated_at": "2023-06-23T10:13:57.000000Z"
                    },
                    {
                        "id": 54,
                        "task_id": 0,
                        "time": 20,
                        "scores": 20,
                        "created_at": "2023-06-23T10:13:57.000000Z",
                        "updated_at": "2023-06-23T10:13:57.000000Z"
                    },
                    {
                        "id": 55,
                        "task_id": 0,
                        "time": 30,
                        "scores": 30,
                        "created_at": "2023-06-23T10:13:57.000000Z",
                        "updated_at": "2023-06-23T10:13:57.000000Z"
                    },
                    {
                        "id": 56,
                        "task_id": 0,
                        "time": 40,
                        "scores": 40,
                        "created_at": "2023-06-23T10:13:57.000000Z",
                        "updated_at": "2023-06-23T10:13:57.000000Z"
                    },
                    {
                        "id": 57,
                        "task_id": 0,
                        "time": 50,
                        "scores": 50,
                        "created_at": "2023-06-23T10:13:57.000000Z",
                        "updated_at": "2023-06-23T10:13:57.000000Z"
                    }
                ]
            }
            api.post('/api/auth/tasks/update/', data)
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
