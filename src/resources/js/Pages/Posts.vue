<template #item.actions="{ item }">
    <div class="container py-5">
        <div v-if="props.flash?.success" class="alert alert-success">
            {{ props.flash.success }}
        </div>

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
                            v-model="search"
                            style="min-width: 250px;"
                        />
                        <button class="btn btn-primary d-flex align-items-center" @click="goToCreate">
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
                    :sort-by="sortBy"
                    @update:sort-by="changeSort"
                >
                    <template #item.description="{ item }">
                        {{ truncateWords(item.description, 12) }}
                    </template>

                    <!-- Здесь вставляем кнопки -->
                    <template #item.actions="{ item }">
                        <button type="button" class="btn btn-primary btn-sm text-white m-1" @click="goToEdit(item.id)">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm text-white" @click="deletePost(item.id)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </template>


                </v-data-table>

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
import {ref, watch} from "vue";
import { router } from '@inertiajs/vue3'
import debounce from 'lodash/debounce'

const itemsPerPage = ref(10);

const goToEdit = (id) => {
    router.get(`/posts/${id}/edit`)
}

// Удаление
const deletePost = (id) => {
    if (!confirm('Вы уверены, что хотите удалить этот пост?')) return
    router.delete(`/posts/${id}`, {}, {
        onSuccess: () => {
            // Можно обновить страницу или перезагрузить список
            router.get('/posts', { page: page.value, search: search.value }, { preserveState: true })
        }
    })
}

// Определяем переменные из контроллера
const props = defineProps({
    posts: Object,
    searchTerm: String,
    flash: {
        type: Object,
        default: () => ({})
    }
})

const search = ref(props.searchTerm);
// Чтобы проще было обращаться
const page = ref(props.posts.meta.current_page)

// Ловить get запросы
const goToPage = (p) => {
    router.get('/posts', { page: p, search: search.value }, { preserveScroll: true, preserveState: true })
}

// Отслеживания url, например для поиска
watch(
    search,
    debounce((q) => {
        router.get('/posts', { search: q }, { preserveState: true })
    }, 500)
)

// Направить на создание
const goToCreate = () => {
    router.get('/posts/create', {}, { only: [] })
}

// Заголовки таблицы-
const headers = [
    { title: 'ID', key: 'id' },
    { title: 'Заголовок', key: 'title' },
    { title: 'Описание', key: 'description' },
    { title: 'Категория', key: 'category_name' },
    { title: 'Создано', key: 'created_at' },
    { title: 'Действия', key: 'actions' },
]

// Сортировка по выбраным столбикам
const sortBy = ref([{ key: 'id', order: 'asc' }])
const changeSort = (sort) => {
    sortBy.value = sort
    const s = sort[0] || { key: 'id', order: 'asc' }

    router.get('/posts', {
        search: search.value,
        sort: s.key,
        direction: s.order
    }, { preserveState: true })
}


// Ограничевает кол-во отображаемых слов в описании
const truncateWords = (text, count = 13) => {
    if (!text) return ''
    const words = text.split(' ')
    return words.length > count ? words.slice(0, count).join(' ') + '…' : text
}
</script>


