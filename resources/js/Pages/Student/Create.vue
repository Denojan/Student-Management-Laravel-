<template>
  <div>
    <h1>Create a Student</h1>
    <div v-if="errors.length > 0">
      <ul>
        <li v-for="error in errors" :key="error">{{ error }}</li>
      </ul>
    </div>
    <form @submit.prevent="submitForm" enctype="multipart/form-data">
      <div>
        <label>Student ID</label>
        <input v-model="form.studentId" type="text" placeholder="ID" />
      </div>
      <div>
        <label>Name</label>
        <input v-model="form.name" type="text" placeholder="Name" />
      </div>
      <div>
        <label>Age</label>
        <input v-model="form.age" type="text" placeholder="Age" />
      </div>
      <div>
        <label>Image</label>
        <input @change="handleFileUpload" type="file" accept="image/*" />
      </div>
      <div>
        <label>Status</label>
        <input v-model="form.status" type="text" placeholder="Status" />
      </div>
      <div>
        <button type="submit">Save a New Student</button>
      </div>
    </form>
  </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';
import { route } from '@inertiajs/inertia-vue3';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
  setup() {
    const { data, setData, errors } = useForm({
      studentId: '',
      name: '',
      age: '',
      image: null,
      status: '',
    });
    const router = useRouter();

    const handleFileUpload = (e) => {
  
  setData('image', e.target.files[0]);
  console.log(data); 
};


    const submitForm = async () => {
      try {
        const formData = new FormData();
        formData.append('studentId', data.studentId);
        formData.append('name', data.name);
        formData.append('age', data.age);
        formData.append('image', data.image);
        formData.append('status', data.status);
    
        await axios.post('/student', formData);

        router.push({ name: 'student.index' });
      } catch (error) {
        console.error('Error submitting form:', error);
      }
    };

    return { form: data, errors, submitForm, handleFileUpload };
  },
};

</script>

