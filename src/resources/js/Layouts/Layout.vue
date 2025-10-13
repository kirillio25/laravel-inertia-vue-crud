<script setup>
import { Link } from "@inertiajs/vue3";
import { onMounted } from "vue";

// пример пользователя
const user = {
    name: "Кирилл",
    avatar: "https://i.pravatar.cc/150?img=32",
};

// Активируем Bootstrap dropdown через JS
onMounted(() => {
    import("bootstrap/dist/js/bootstrap.bundle.min.js");
});
</script>

<template>
    <Head title="App" />

    <header class="navbar navbar-expand-lg navbar-dark shadow sticky-top py-3 bg-gradient-custom">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Логотип -->
            <Link
                :href="route('home')"
                class="navbar-brand fw-bold fs-4 d-flex align-items-center text-white"
            >
                <i class="bi bi-moon-stars-fill me-2 text-warning"></i> AuroraApp
            </Link>

            <!-- Бургер -->
            <button
                class="navbar-toggler border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Навигация -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item">
                        <Link
                            :href="route('home')"
                            class="nav-link fw-semibold text-white rounded-pill px-3 hover-nav"
                        >🏠 Главная</Link>
                    </li>
                    <li class="nav-item">
                        <Link
                            :href="route('posts.index')"
                            class="nav-link fw-semibold text-white rounded-pill px-3 hover-nav"
                        >💡 Посты</Link>
                    </li>

                    <!-- Пользователь -->
                    <li class="nav-item dropdown">
                        <a
                            href="#"
                            class="nav-link dropdown-toggle d-flex align-items-center gap-2 text-white fw-semibold"
                            id="userDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <img
                                :src="user.avatar"
                                class="rounded-circle border border-light"
                                style="width: 36px; height: 36px; object-fit: cover;"
                            />
                            {{ user.name }}
                        </a>

                        <ul
                            class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2"
                            aria-labelledby="userDropdown"
                        >
                            <li>
                                <Link href="#" class="dropdown-item py-2">
                                    ⚙️ Настройки
                                </Link>
                            </li>
                            <li>
                                <Link href="#" class="dropdown-item py-2 text-danger">
                                    🚪 Выйти
                                </Link>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <main class="container py-4">
        <slot />
    </main>

    <!-- 🔹 Подвал -->
    <footer class="bg-gradient-custom text-white py-4 mt-5 shadow-sm">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-moon-stars-fill text-warning"></i>
                <span class="fw-semibold">AuroraApp</span>
                <small class="text-white-50">© 2025 Все права защищены</small>
            </div>

            <div class="d-flex gap-3">
                <Link href="#" class="text-white text-decoration-none hover-opacity">Политика</Link>
                <Link href="#" class="text-white text-decoration-none hover-opacity">Контакты</Link>
                <Link href="#" class="text-white text-decoration-none hover-opacity">Помощь</Link>
            </div>
        </div>
    </footer>
</template>

<style scoped>
/* 🌈 Градиентный фон */
.bg-gradient-custom {
    background: linear-gradient(90deg, #ff00cc, #3333ff);
}

.hover-nav:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

/* Выпадающее меню */
.dropdown-menu {
    border-radius: 12px;
    overflow: hidden;
    animation: fadeIn 0.25s ease;
}
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.dropdown-item:hover {
    background-color: #f8f9fa;
}

/* 🔹 Эффект при наведении на ссылки футера */
.hover-opacity:hover {
    opacity: 0.8;
}
</style>
