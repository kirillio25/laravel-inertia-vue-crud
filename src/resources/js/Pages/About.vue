<template>
    <div class="container py-4">
        <div class="bg-white rounded-4 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <div>
                    <h3 class="fw-semibold mb-0">Посты</h3>
                    <small class="text-muted">Всего {{ items.length }} записей</small>
                </div>
                <button class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Добавить
                </button>
            </div>

            <v-data-table
                :headers="headers"
                :items="items"
                :items-per-page="5"
                class="border rounded-3"
            ></v-data-table>
        </div>
    </div>
</template>


<script setup>
import { ref } from 'vue'

// Заголовки таблицы
const headers = [
    { title: 'ID', key: 'id' },
    { title: 'Заголовок', key: 'title' },
    { title: 'Описание', key: 'description' },
    { title: 'Категория (ID)', key: 'category_id' },
    { title: 'Создано', key: 'created_at' },
]

// Тестовые данные
const items = ref([
    {
        id: 1,
        title: 'Первый пост',
        description: 'Это описание первого поста. Очень интересная статья!',
        category_id: 2,
        created_at: '2025-10-10 14:22:00',
    },
    {
        id: 2,
        title: 'Laravel + Vue',
        description: 'Как соединить Laravel с Vue и построить SPA.',
        category_id: 1,
        created_at: '2025-10-11 09:15:00',
    },
    {
        id: 3,
        title: 'Docker для разработчиков',
        description: 'Основы Docker и docker-compose для Laravel проектов.',
        category_id: 3,
        created_at: '2025-10-12 10:30:00',
    },
])
</script>
