<template>
    <div class="container py-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-semibold mb-1">Посты</h4>
                        <small class="text-muted">Всего {{ props.posts.meta.total }} записей</small>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <v-text-field
                            label="Поиск"
                            prepend-inner-icon="mdi-magnify"
                            variant="outlined"
                            density="compact"
                            hide-details
                            class="m-0"
                            style="min-width: 250px;"
                        />
                        <button class="btn btn-primary d-flex align-items-center">
                            <i class="bi bi-plus-lg me-1"></i> Добавить
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body pt-4">
                <v-data-table
                    :headers="headers"
                    :items="props.posts.data"
                    v-model:items-per-page="itemsPerPage"
                    hide-default-footer
                    class="rounded-3"
                />

                <div class="d-flex justify-content-center mt-4">
                    <v-pagination
                        v-model="page"
                        :length="props.posts.meta.last_page"
                        @update:modelValue="goToPage"
                    />
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
const itemsPerPage = ref(10);

// Определяем переменные из контроллера
const props = defineProps({
    posts: Object,
})

// Чтобы проще было обращаться
const page = ref(props.posts.meta.current_page)

// Ловить get запросы
const goToPage = (p) => {
    router.get(route('posts.index', { page: p }), {}, { preserveScroll: true })
}

// Заголовки таблицы-
const headers = [
    { title: 'ID', key: 'id' },
    { title: 'Заголовок', key: 'title' },
    { title: 'Описание', key: 'description' },
    { title: 'Категория', key: 'category_name' },
    { title: 'Создано', key: 'created_at' },
]
</script>


