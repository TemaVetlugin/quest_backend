<template>
    <div>
        Пользовательское прохождение

        <input v-model="questId" type="text" class="form-control mt-3 mb-3" placeholder="Айди Квеста пользователя">

        <a href="#" class="btn btn-success mb-5" @click.prevent="start">Участвовать</a>

        <input v-model="cancelQuestId" type="text" class="form-control mt-3 mb-3" placeholder="Айди Квеста пользователя">

        <a href="#" class="btn btn-danger mb-5" @click.prevent="cancel">Прервать</a>

        <input v-model="qrKey" type="text" class="form-control mt-3 mb-3" placeholder="Ключ задания из qr кода">

        <a href="#" class="btn btn-success mb-5" @click.prevent="qrCodeCheck">Проверить</a><br>

        <input v-model="questEnd" type="text" class="form-control mt-3 mb-3" placeholder="Айди квеста">
        <input v-model="questScores" type="text" class="form-control mt-3 mb-3" placeholder="Баллы квеста">

        <a href="#" class="btn btn-success mb-5" @click.prevent="questDone">Закончить</a><br>

        <input v-model="nextTask" type="text" class="form-control mt-3 mb-3" placeholder="Ключ следующего задания">
        <p>можно отправить пустым. Тогда прользователю присвоится null, соответственно он сможет начать новый квест</p>
        <a href="#" class="btn btn-success mb-5" @click.prevent="taskDone">Закончить задание</a><br>

        Командное прохождение

        <input v-model="questId" type="text" class="form-control mt-3 mb-3" placeholder="Айди Квеста команды">

        <a href="#" class="btn btn-success mb-5" @click.prevent="start">Участвовать</a>

        <input v-model="cancelQuestId" type="text" class="form-control mt-3 mb-3" placeholder="Айди Квеста команды">

        <a href="#" class="btn btn-danger mb-5" @click.prevent="cancel">Прервать</a>

        <input v-model="qrKey" type="text" class="form-control mt-3 mb-3" placeholder="Ключ задания из qr кода">

        <a href="#" class="btn btn-success mb-5" @click.prevent="qrCodeCheck">Проверить</a><br>

        <input v-model="questEnd" type="text" class="form-control mt-3 mb-3" placeholder="Айди квеста">
        <input v-model="questScores" type="text" class="form-control mt-3 mb-3" placeholder="Баллы квеста">

        <a href="#" class="btn btn-success mb-5" @click.prevent="questDone">Закончить</a><br>

        <input v-model="nextTask" type="text" class="form-control mt-3 mb-3" placeholder="Ключ следующего задания">
        <p>можно отправить пустым. Тогда прользователю присвоится null, соответственно он сможет начать новый квест</p>
        <a href="#" class="btn btn-success mb-5" @click.prevent="taskDone">Закончить задание</a><br>
    </div>
</template>

<script>
import api from "../../api.js"

export default {
    data() {
        return {
            questId: null,
            taskId: 6,
            taskKey: null,
            cancelQuestId: null,
            qrKey: null,
            questEnd:null,
            questScores:null,
            nextTask: null,
        }
    },
    methods: {
        start() {
            //Получение данных о квесте+задания+подсказки к ним
            api.get(`/api/auth/users/quest/${this.questId}`)
                .then(res => {
                    console.log(res);
                    if(res.data.tasks&&res.data.tasks[0]) {
                        this.taskId = res.data.tasks[0].key;
                        console.log(res.data.tasks[0].key);
                        //Добавление первого задания квеста в таблицу пользователя. Можно использовать
                        //для добавления задания вне кнопки квеста.

                        api.post('/api/auth/users/task', {task_key: this.taskId})
                            .then(res => {
                                // console.log(res);
                            })
                    }
                })
                .catch(err=>{
                    console.log(err);
                })

        },
        cancel() {
            //Получение данных о квесте+задания+подсказки к ним
            api.get(`/api/auth/users/quest/cancel/${this.cancelQuestId}`)
                .then(res => {
                    console.log(res);
                })
                .catch(err=>{
                    console.log(err);
                })

        },
        qrCodeCheck() {
            //Получение данных о квесте+задания+подсказки к ним
            api.post(`/api/auth/users/task/check/`,{qrKey: this.qrKey})
                .then(res => {
                    console.log(res);
                })
                .catch(err=>{
                    console.log(err);
                })

        },
        questDone() {
            api.post(`/api/auth/users/quest/done/`,{quest_id: this.questEnd, quest_scores: this.questScores})
                .then(res => {
                    console.log(res);
                })
                .catch(err=>{
                    console.log(err);
                })

        },
        taskDone() {
            api.post(`/api/auth/users/task/`,{task_key: this.nextTask})
                .then(res => {
                    console.log(res);
                })
                .catch(err=>{
                    console.log(err);
                })

        },
        startTeam() {

                    api.post('/api/auth/teams/task',{team_id: 1, task_key:this.taskKey})
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

        onFileSelected(event) {
            this.photo = event.target.files[0];
        },
    }
}
</script>

<style>

</style>
