<template>
    <div class="container py-5">
        <h4>Создать пост</h4>

        <v-text-field
            label="Заголовок"
            v-model="title"
            :error-messages="errors.title"
            @input="clearError('title')"
            required
        />

        <v-textarea
            label="Описание"
            v-model="description"
            :error-messages="errors.description"
            @input="clearError('description')"
            required
        />

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
            <v-btn color="primary" @click="submit">Опубликовать</v-btn>
            <v-btn text @click="cancel">Отмена</v-btn>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    post: {
        type: Object,
        default: () => ({
            title: '',
            description: '',
            category_id: null
        })
    },
    categories: {
        type: Array,
        default: () => []
    }
})

const title = ref(props.post.title)
const description = ref(props.post.description)
const category_id = ref(props.post.category_id)

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

// Отправка
const submit = () => {
    if (!validate()) return

    router.post('/posts', {
        title: title.value,
        description: description.value,
        category_id: category_id.value
    })
}

const cancel = () => router.get('/posts')
</script>
