<template>
    <header>
        <ul class="flex border-b mt-5">
            <li class="-mb-px mr-1">
                <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold" href="#"><router-link :to="'/register'">Create account here</router-link></a>
            </li>
            <li class="-mb-px mr-1">
                <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold" href="#"><router-link :to="'/dashboard/' + offset">Dashboard</router-link></a>
            </li>
        </ul>
    </header>
  
    <div class="flex justify-center">
        <div class="w-full max-w-xs">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"  @submit.prevent="login">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" name="email" v-model="email" placeholder="Username">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" v-model="password" placeholder="******************">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import store from '../store/store';
    import router from '../router/router';

    export default {
        data() {
            return {
                email: '',
                password: '',
                offset: 0
            }
        },
        methods: {
            login() {
                axios.post('api/login', {
                    email: this.email,
                    password: this.password
                })
                .then(res => {
                    store.state.user= res.data.user;
                    store.state.user.token= res.data.access_token;

                    localStorage.setItem('user_id', res.data.user.id);
                    localStorage.setItem('token', res.data.access_token);
                    
                    router.push('dashboard/' + this.offset);
                })
                .catch(err => console.log(err));
            }
        }
    }
</script>