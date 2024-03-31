import { createWebHistory, createRouter } from 'vue-router';
import StudentsIndex from './Pages/Student/Index.vue';
import StudentCreate from './Pages/Student/Create.vue';

const routes = [
  { path: '/students', component: StudentsIndex },
  { path: '/student/create', component: StudentCreate },
  // Add more routes as needed
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
