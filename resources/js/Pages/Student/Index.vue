<template>
  <div>
    <h1 class="mb-8 text-3xl font-bold">All Student</h1>
    <div>
      <div v-if="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ successMessage }}</span>
      </div>
      <Link href="/student/create" method="get" as="button">Create a student</Link>
    </div>
    <div v-if="students.length > 0">
      <table border="1">
       
        <tr>
          <th>ID</th>
          <th>Student ID</th>
          <th>Name</th>
          <th>Age</th>
          <th>Image</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
        <!-- Table data -->
        <tr v-for="student in students" :key="student.id">
          <td>{{ student.id }}</td>
          <td>{{ student.studentId }}</td>
          <td>{{ student.name }}</td>
          <td>{{ student.age }}</td>
          <td>
            <img v-if="student.image" :src="'/storage/images/' + student.image" alt="Student Image" width="100">
            <span v-else>No Image</span>
          </td>
          <td>{{ student.status }}</td>
          <td>
           
            <Link :href="editStudentRoute(student.id)">Edit</Link>
          </td>
          <td>
            <button @click="deleteStudent(student.id)">Delete</button>
          </td>
        </tr>
      </table>
    </div>
    <div v-else>
      <p>No students found</p>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import { useRoute } from 'vue-router'; 
import axios from 'axios';
import { ref } from 'vue';
export default {
  components: {
    Head,
    Link,
  },
  props: {
    students: {
      type: Array,
      required: true,
    },
  },
  setup() {
    
    const route = useRoute(); 
    const successMessage = ref(null);
    const deleteStudent = async (studentId) => {
      try {
        await axios.delete(`/student/${studentId}/destroy`);
        successMessage.value = 'Student deleted successfully';
        console.log('Student deleted successfully');
       
      } catch (error) {
        console.error('Error deleting student:', error);
      }
    };
    const editStudentRoute = (Id) => {
      return `/student/${Id}/edit`; 
    };

    return { editStudentRoute, deleteStudent, successMessage };
  },
};
</script>
