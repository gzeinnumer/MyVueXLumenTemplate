<template lang="html">
    <section class="login">
        <div class="wrapper d-flex align-items-center auth login-full-bg">
            <div class="row w-100">
                <div class="col-lg-6 mx-auto">
                    <div class="auth-form-dark text-left p-5">
                        <h2>Login</h2>
                        <h4 class="font-weight-light">Hello! let's get started</h4>
                        <form class="pt-5">
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input v-model="form.email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" />
                                    <i class="mdi mdi-account"></i>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input v-model="form.password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" />
                                    <i class="mdi mdi-eye"></i>
                                </div>
                                <div class="mt-5">
                                    <a @click="login()" class="btn btn-block btn-warning btn-lg font-weight-medium">Login</a>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="#" class="auth-link text-white">Forgot password?</a>
                                </div>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script lang="js">
/* eslint-disable */
    export default {
      name: 'login',
      data () {
        return {
          form: {
            email: '',
            password: ''
          }
        }
      },
      methods: {
        login() {
            const qs = require('qs');
            this.axios({
                method: 'post',
                url: 'http://localhost:7000/api/login',
                data: qs.stringify({
                    email: this.form.email,
                    password: this.form.password
                }),
                headers: {
                    'content-type': 'application/x-www-form-urlencoded;charset=utf-8'
                }
            })
            .then((response) => {
                this.form.email = '';
                this.form.password = '';
                console.log(response);
            })
            .catch(function (response) {
                console.log(response);
            });
        },
      }
    }
</script>

<style scoped lang="scss">
    .login {
    }
</style>
