<template>
    <div class="p-6 ml-6 mt-4 mr-6" style="display: flex; justify-content: flex-end;"> 
        <button type="button" class="relative inline-flex items-center justify-center inline-block p-4 px-5 py-3 overflow-hidden font-medium text-indigo-600 rounded-lg shadow-2xl group" @click="logout()">
            <span class="absolute top-0 left-0 w-40 h-40 -mt-10 -ml-3 transition-all duration-700 bg-red-500 rounded-full blur-md ease"></span>
            <span class="absolute inset-0 w-full h-full transition duration-700 group-hover:rotate-180 ease">
            <span class="absolute bottom-0 left-0 w-24 h-24 -ml-10 bg-purple-500 rounded-full blur-md"></span>
            <span class="absolute bottom-0 right-0 w-24 h-24 -mr-10 bg-pink-500 rounded-full blur-md"></span>
            </span>
            <span class="relative text-white">Logout</span>
        </button>
    </div>
    <div class=" p-6">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-1 lg:-mx-1">
                <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-center">
                            <thead class="border-b bg-violet-800">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                        Name
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                        <a href="">Informations</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b" v-for="pokemon in pokemons">
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <strong>{{ pokemon.name }}</strong>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <button type="button" @click="showDetails(pokemon.name)"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axiosClient from '../axios/axios';
    import router from '../router/router';
    export default {
        mounted() {
            console.log("Component mounted.");
        },
        data() {
            return {
                item: '',
                pokemons: {},
                offset: 0, 
            };
        },
        created() {
                axiosClient.get('dashboard/' + this.offset).then(res => {
                    this.pokemons = res.data.results;
                });
                
        },
        methods: {
            logout() {
                axios.post('/api/logout/' + localStorage.getItem('user_id')).then(res => {
                    console.log(res);
                    router.push('/');
                });
            },
            
            showDetails(name) {
                axiosClient.get('pokemon/' + name ).then(res => {
                    router.push({path:'/details/' + name, params: {name}});
                });

            },
        }
    };
</script>