<template>
    <div>
      <h1 class="mb-8 text-3xl font-bold">Edit Student</h1>
      <form @submit.prevent="submitForm">
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
          
          <button type="submit">Update Student</button>
        </div>
      </form>
    </div>
  </template>
  
<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import {  put } from '@inertiajs/inertia';
import { reactive } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

export default {
  components: {
    Head,
    Link,
  },
  props: {
    student: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const form = reactive({
      studentId: props.student.studentId,
      name: props.student.name,
      age: props.student.age,
      image: null,
      status: props.student.status,
    });

    const handleFileUpload = (e) => {
      form.image = e.target.files[0];
    };
    const updateRouteUrl = `/student/${props.student.id}/update`;
    const submitForm = () => {
      const formData = new FormData();
      formData.append('studentId', form.studentId);
      formData.append('name', form.name);
      formData.append('age', form.age);
      formData.append('image', form.image);
      formData.append('status', form.status);
      

    
      put(updateRouteUrl, formData, {
    onSuccess: () => {
     
      window.location.href = '/students';
    },
    onError: (errors) => {
      
      console.error(errors);
    },
  });
    };

    return { form, submitForm, handleFileUpload };
  },
};
</script>


  