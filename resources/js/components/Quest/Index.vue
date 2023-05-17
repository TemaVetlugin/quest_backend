<template>
    <div>
        <div class="w-75">

            <input v-model="newQuest.title" type="text" class="form-control mt-3 mb-3" placeholder="Название">
            <input v-model="newQuest.purpose" type="text" class="form-control mb-3" placeholder="Цель">
            <input v-model="newQuest.time" type="text" class="form-control mb-3" placeholder="Время выполнения">
            <input v-model="newQuest.length" type="text" class="form-control mb-3" placeholder="Длина пути">
            <input v-model="newQuest.description" type="text" class="form-control mb-3" placeholder="Описание">
            <input v-model="newQuest.final" type="text" class="form-control mb-3" placeholder="Финал">
            <input v-model="newQuest.start_info" type="text" class="form-control mb-3"
                   placeholder="Стартовая информация">
            <input type="submit" @click.prevent="addTask" class="btn btn-primary mb-3" value="Добавить задание">
            <input type="submit" @click.prevent="deleteTask" class="btn btn-danger mb-3 ms-3" value="Убрать задание">
        </div>
        <template v-for="(task, index) in tasks" :key="index">
            <p>{{ index }}</p>
            <div class="d-flex">
                <div class="w-50 ">
                    <input v-model="task.start" type="text" class="form-control mb-3" placeholder="Стартовая точка">
                    <input v-model="task.address" type="text" class="form-control mb-3" placeholder="Адрес">
                    <input v-model="task.question" type="text" class="form-control mb-3" placeholder="Вопрос">
                    <input v-model="task.answer" type="text" class="form-control mb-3" placeholder="Ответ">
                    <input v-model="task.scores" type="text" class="form-control mb-3" placeholder="Баллы">
                    <div class="mb-3">
                        <h4 class="text-dark">Добавить изображение к подсказке</h4>
                        <input v-on:change="onFileSelected" class="form-control w-75" type="file" :data-id="index" id="formFile">
                    </div>
                    <img v-if="this.qrs[index]" :src="this.qrs[index]" alt="QR Code">
                    <hr>
                </div>
                <div class="ms-4 w-50">
                    <template v-for="(hint, index1) in hints" :key="index1">
                        <template v-if="index===hint.task_id">

                            {{ index1 }}
                            <p>{{ index }}</p>
                            <input v-model="hint.title" type="text" class="form-control mb-3" placeholder="Подсказка">
                            <input v-model="hint.description" type="text" class="form-control mb-3" placeholder="Подсказка">
                            <input v-model="hint.scores" type="text" class="form-control mb-3" placeholder="Баллы">
                            <input type="submit" @click.prevent="deleteHint(index1)" class="btn btn-danger mb-3"
                                   value="Удалить подсказку">
                            <hr>
                        </template>
                    </template>
                    <input type="submit" @click.prevent="addHint(index)" class="btn btn-success mb-3"
                           value="Добавить подсказку">
                </div>
            </div>
        </template>
        <br>
        <input type="submit" @click.prevent="storeQuest" class="btn btn-primary mb-3" value="send">

    </div>
</template>

<script>
import api from "../../api.js"
//TODO сделать проверку при удалении заданий на наличие подсказок. Чтобы сначала удалялись подсказки, затем задания.
export default {
    data() {
        return {
            newQuest: {},
            tasks: [],
            hints: [],
            files: [],
            api: null,
            quests: null,
            indexTask: 0,
            indexHint: 0,
            qrImageUrl: '',
            qrs: [],
        }
    },


    methods: {
        addTask() {
            this.tasks[this.indexTask] = {};
            this.files[this.indexTask] = null;
            this.indexTask++;
            console.log(this.tasks);
        },
        addHint(index) {
            this.hints[this.indexHint] = {task_id: index};
            this.indexHint++;
            console.log(this.hints);
        },
        deleteTask() {
            if (this.indexTask > 0) {
                this.indexTask--;
                this.tasks.splice(this.indexTask, 1);
                this.files.splice(this.indexTask, 1);
                // delete this.tasks[this.indexTask];
            }
        },
        deleteHint(index) {

            this.indexHint--;
                this.hints.splice(index, 1);
        },
        storeQuest() {
            api.post('/api/auth/quests', this.newQuest)
                .then(res => {
                    // привязка заданий к квесту
                    for (let key in this.tasks) {
                        this.tasks[key].quest_id = res.data;
                    }

                    //перед добавлением заданий необходимо создать объект для хранения файлов

                    const formData = new FormData();
                    // Добавляем каждый объект массива в FormData
                    this.tasks.forEach((task, index) => {
                        // Преобразуем объект в JSON и добавляем его в FormData
                        formData.append(`tasks[${index}]`, JSON.stringify(task));
                    });
                    for (let i = 0; i < this.files.length; i++) {
                        const file = this.files[i];
                            formData.append(`files[${i}]`, file);
                    }

                    //добавление заданий
                        if(this.tasks.lenght!==0) {
                            api.post('/api/auth/tasks', formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            })
                                .then(res => {
                                    // const blob = new Blob([res.data], { type: 'image/png' });
                                    // this.qrImageUrl = res.data;

                                    console.log(res);
                                    // Добавление qr кодов в массив
                                    for (let index in res.data.task_ids) {
                                        this.qrs[index] = res.data.qrs[index];
                                        console.log(this.qrs);
                                    }
                                    //присваивание подсказок к полученным с бэка айди заданий,
                                    for (let key in this.hints) {
                                        for (let index in res.data.task_ids) {
                                            this.qrs[index] = res.data.qrs[index];
                                            console.log(res.data.qrs[index]);
                                            if (this.hints[key].task_id == index)
                                                this.hints[key].task_id = res.data.task_ids[index];

                                        }
                                    }
                                    //добавление подсказок
                                    // console.log(this.hints)
                                    if (this.hints.lenght !== 0) {
                                        api.post('/api/auth/hints', {hints: this.hints}, {
                                            headers: {
                                                'Content-Type': 'application/json',
                                            }
                                        })
                                            .then(res => {

                                                // console.log(res);
                                                // console.log(this.tasks);
                                            })
                                            .catch(err => {
                                                console.log(err);
                                            })
                                    }
                                })
                                .catch(err => {
                                    console.log(err);
                                })
                        }
                })
                .catch(err => {
                    console.log(err);
                })
        },
        onFileSelected(event) {
            const id = event.target.dataset.id;
            this.files[id]=event.target.files[0];
            // let object =
            // console.log(object);
            // this.indexTask--
            // console.log(this.tasks[this.indexTask]);
            //
            // this.indexTask++
            console.log(this.files);
        },

    }
}
</script>

<style>

</style>
