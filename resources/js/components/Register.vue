<template>
    <header>
        <ul class="flex border-b mt-5">
            <li class="-mb-px mr-1">
                <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold" href="#"><router-link :to="'/'">Login</router-link></a>
            </li>
            <li class="-mb-px mr-1">
                <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold" href="#"><router-link :to="'/dashboard/' + offset">Dashboard</router-link></a>
            </li>
        </ul>
    </header>
     <div class="flex justify-center">
        <div class="w-full max-w-xs">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"  @submit.prevent="register">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Email
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" name="email" v-model="email" placeholder="youemail@mail.com">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="name" v-model="name" placeholder="Username">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" v-model="password" placeholder="******************">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Confim password
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password_confirmation" v-model="passwordConfirmation" placeholder="******************">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import router from '../router/router';
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                passwordConfirmation: '',
                offset: 0,
            }
        },
        methods: {
            register() {
                axios.post('api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    passwordConfirmation: this.passwordConfirmation
                })
                    .then(res => {
                        router.push('/');
                    })
                    .catch(err => console.log(err));
            }
        }
    }
</script>
