<template>
    <div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 noPadding">
                    <div class="left-sidebar">
                        <a href="/" title="Logo">
                            <img src="/images/logo/logo-white.svg" alt="Logo">
                        </a>
                        <div class="slogan">
                            <h4>
                                Save money by using Barter9.com
                            </h4>
                            <h6>
                                Barter9.com is marketplace where everyone can barter products, services.
                            </h6>
                        </div>
                        <div class="elements">
                            <svg width="400" height="180">
                                <rect x="60" y="50" width="100" height="100" rx="20"
                                      style="fill:#7ED0F2;" />
                                <rect x="83" y="2" width="125" height="125" rx="20"
                                      style="fill:#66BDE1;" />
                                <rect x="40" y="100" width="75" height="75" rx="20"
                                      style="fill:#8FDDFC;" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="right-sidebar">
                        <div class="back">
                            <a href="/" title="Home">
                                <i class="fas fa-chevron-left"></i> Back Home
                            </a>
                        </div>
                        <h2>Register an account</h2>
                        <h6>Please fill inputs below:</h6>


                        <div class="form">
                            <form @submit.prevent="submit">

                                <div class="form-group">
                                    <input type="text"
                                           v-model="form.name"
                                           @change="updateError('name')"
                                           class="form-control"
                                           placeholder=" "
                                           required>
                                    <span class="floating-label">Your name</span>
                                </div>
                                <div v-if="this.errorHints.name" class="errorHints">{{this.errorHints.name}}</div>

                                <div class="form-group">
                                    <input type="email"
                                           v-model="form.email"
                                           @change="updateError('email')"
                                           class="form-control"
                                           placeholder=" "
                                           required>
                                    <span class="floating-label">E-mail</span>
                                </div>
                                <div v-if="this.errorHints.email" class="errorHints">{{this.errorHints.email}}</div>

                                <div class="form-group">
                                    <input type="password"
                                           v-model="form.password"
                                           @change="updateError('password')"
                                           class="form-control"
                                           placeholder=" "
                                           required>
                                    <span class="floating-label">Password</span>
                                </div>
                                <div v-if="this.errorHints.password" class="errorHints">{{this.errorHints.password}}</div>
                                <div v-if="this.errorHints.auth" class="errorHints">{{this.errorHints.auth}}</div>

                                <button class="btn" >Register</button>
                            </form>
                        </div>

                        <div class="forgot-password"><a href="/">Forgot password</a></div>
                        <div class="register">Do you already have an account?
                            <router-link
                                    tag="a"
                                    :to="{path: 'login'}"
                                    style="cursor:pointer;"
                                    >Login</router-link>
                        </div>

                    </div>
                </div>

            </div>
        </div>


    </div>

</template>
<script scoped src="./js/registration.js"></script>
<style scoped lang="scss" src="./css/style.scss"></style>