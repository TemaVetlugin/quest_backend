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
        <input v-model="questTime" type="text" class="form-control mt-3 mb-3" placeholder="Баллы квеста">

        <a href="#" class="btn btn-success mb-5" @click.prevent="questDone">Закончить</a><br>

        <input v-model="nextTask" type="text" class="form-control mt-3 mb-3" placeholder="Ключ следующего задания">
        <p>можно отправить пустым. Тогда прользователю присвоится null, соответственно он сможет начать новый квест</p>
        <a href="#" class="btn btn-success mb-5" @click.prevent="taskDone">Закончить задание</a><br>
    </div>
    <div>
        Командное прохождение

        <input v-model="questIdTeam" type="text" class="form-control mt-3 mb-3" placeholder="Айди Квеста команды">

        <a href="#" class="btn btn-success mb-5" @click.prevent="startTeam">Участвовать</a>

        <input v-model="cancelQuestIdTeam" type="text" class="form-control mt-3 mb-3" placeholder="Айди Квеста команды">

        <a href="#" class="btn btn-danger mb-5" @click.prevent="cancelTeam">Прервать</a>

        <input v-model="qrKeyTeam" type="text" class="form-control mt-3 mb-3" placeholder="Ключ задания из qr кода">

        <a href="#" class="btn btn-success mb-5" @click.prevent="qrCodeCheckTeam">Проверить</a><br>

        <input v-model="questEndTeam" type="text" class="form-control mt-3 mb-3" placeholder="Айди квеста">
        <input v-model="questScoresTeam" type="text" class="form-control mt-3 mb-3" placeholder="Баллы квеста">
        <input v-model="questTimeTeam" type="text" class="form-control mt-3 mb-3" placeholder="Время квеста">

        <a href="#" class="btn btn-success mb-5" @click.prevent="questDoneTeam">Закончить</a><br>

        <input v-model="nextTaskTeam" type="text" class="form-control mt-3 mb-3" placeholder="Ключ следующего задания">
        <p>можно отправить пустым. Тогда прользователю присвоится null, соответственно он сможет начать новый квест</p>
        <a href="#" class="btn btn-success mb-5" @click.prevent="taskDoneTeam">Закончить задание</a><br>
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
            questTime:null,


            questIdTeam: null,
            taskIdTeam: 6,
            taskKeyTeam: null,
            cancelQuestIdTeam: null,
            qrKeyTeam: null,
            questEndTeam:null,
            questScoresTeam:null,
            questTimeTeam:null,
            nextTaskTeam: null,
            team_id: null,
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
            api.post(`/api/auth/users/quest/done/`,{quest_id: this.questEnd, quest_scores: this.questScores, time: this.questTime})
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
            //Получение данных о квесте+задания+подсказки к ним
            api.get(`/api/auth/teams/quest/${this.questIdTeam}`)
                .then(res => {
                    console.log(res);
                    if(res.data.tasks&&res.data.tasks[0]) {
                        this.taskIdTeam = res.data.tasks[0].key;
                        console.log(res.data.tasks[0].key);
                        //Добавление первого задания квеста в таблицу пользователя. Можно использовать
                        //для добавления задания вне кнопки квеста.

                        api.post('/api/auth/teams/task', {task_key: this.taskIdTeam})
                            .then(res => {
                                // console.log(res);
                            })
                    }
                })
                .catch(err=>{
                    console.log(err);
                })

        },
        cancelTeam() {
            //Получение данных о квесте+задания+подсказки к ним
            api.get(`/api/auth/teams/quest/cancel/${this.cancelQuestIdTeam}`)
                .then(res => {
                    console.log(res);
                })
                .catch(err=>{
                    console.log(err);
                })

        },
        qrCodeCheckTeam() {
            //Получение данных о квесте+задания+подсказки к ним
            api.post(`/api/auth/users/task/check/`,{qrKey: this.qrKeyTeam})
                .then(res => {
                    console.log(res);
                })
                .catch(err=>{
                    console.log(err);
                })

        },
        questDoneTeam() {
            api.post(`/api/auth/teams/quest/done/`,{quest_id: this.questEndTeam, quest_scores: this.questScoresTeam, time:this.questTimeTeam})
                .then(res => {
                    console.log(res);
                })
                .catch(err=>{
                    console.log(err);
                })

        },
        taskDoneTeam() {
            api.post(`/api/auth/teams/task/`,{task_key: this.nextTaskTeam})
                .then(res => {
                    console.log(res);
                })
                .catch(err=>{
                    console.log(err);
                })

        },


    }
}
</script>

<style>

</style>
