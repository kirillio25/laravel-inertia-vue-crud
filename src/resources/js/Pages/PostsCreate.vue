<template>
    <div class="container py-5">
        <h4>Редактировать пост</h4>

        <!-- Заголовок -->
        <v-text-field
            label="Заголовок"
            v-model="title"
            :error-messages="errors.title"
            @input="clearError('title')"
            required
        />

        <!-- Описание -->
        <v-textarea
            label="Описание"
            v-model="description"
            :error-messages="errors.description"
            @input="clearError('description')"
            required
        />

        <!-- Категория -->
        <v-select
            label="Категория"
            :items="categories"
            item-title="name"
            item-value="id"
            v-model="category_id"
            :error-messages="errors.category_id"
            @change="clearError('category_id')"
            required
        />

        <div class="mt-3 d-flex gap-2">
            <v-btn color="primary" @click="update">Сохранить</v-btn>
            <v-btn text @click="cancel">Отмена</v-btn>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

// Определяем переменные из контроллера
const props = defineProps({
    post: Object,
    categories: Array,
})

// Подставляем текущие значения поста
const title = ref(props.post.title)
const description = ref(props.post.description)
const category_id = ref(props.post.category_id)

// Ошибки валидации
const errors = ref({ title: null, description: null, category_id: null })

const clearError = (field) => { errors.value[field] = null }

// Валидация на клиенте
const validate = () => {
    let valid = true
    if (!title.value.trim()) { errors.value.title = 'Заголовок обязателен'; valid = false }
    if (!description.value.trim()) { errors.value.description = 'Описание обязательно'; valid = false }
    if (!category_id.value) { errors.value.category_id = 'Выберите категорию'; valid = false }
    return valid
}

// Обновление поста
const update = () => {
    if (!validate()) return

    router.put(`/posts/${props.post.id}`, {
        title: title.value,
        description: description.value,
        category_id: category_id.value
    })
}

// Отмена
const cancel = () => router.get('/posts')
</script>
