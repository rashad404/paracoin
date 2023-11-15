<template>
    <div>

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="left-container">
                        <h1>{{moduleTitle}}</h1>

<!--                        Pages-->
                        <div class="module-box">
                            <div class="module-header">
                                <h2>Static Pages</h2>
                            </div>
                            <div class="module-body">
                                <h6>How many static pages will be?</h6><br/>
                                <div class="range-box">
                                    <span class="min">{{pageCountMin}}</span>
                                    <input type="range" class="custom-range" v-model=page_count :min=pageCountMin :max=pageCountMax step="1" id="pageRange">
                                    <span class="max">{{pageCountMax}}</span>
                                </div>

                                <div class="row" style="margin-top: 40px;">
                                    <div class="col-md-4">
                                        <br/>
                                        <h6>Design complexity:</h6>
                                    </div>
                                    <div class="col-md-8">

                                        <div class="range-box-title">
                                            <div>
                                                Simple
                                            </div>
                                            <div>
                                                Medium
                                            </div>
                                            <div>
                                                Custom
                                            </div>
                                        </div>
                                        <div class="range-box">
                                            <input type="range" class="custom-range full" v-model=design_type :min=1 :max=2 step="0.5">
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="module-footer d-flex justify-content-between">
                                <div class="key">
                                    Cost:
                                </div>
                                <div class="value">
                                    <span class="selectedValue" v-show=true>{{page_count}}
                                        <span v-if="page_count==1">page</span>
                                        <span v-else>pages</span>
                                    </span> / ${{pageCost}}
                                </div>
                            </div>
                        </div>


<!--                        Website Add-ons-->
                        <div v-if="1===1" class="module-box">
                            <div class="module-header">
                                <h2>Website Add-ons</h2>
                            </div>
                            <div class="module-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-between">
                                            <span class="selectedValue">Responsive</span>
                                            <label class="switch-button">
                                                <input type="checkbox" checked ref="responsive" v-on:click="selectedCheck('add_ons', 'responsive')">
                                                <span class="slider-button round"></span>
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <span class="selectedValue">Member login /‍‍‍ Profiles</span>
                                            <label class="switch-button">
                                                <input type="checkbox" ref="member_login" v-on:click="selectedCheck('add_ons', 'member_login')">
                                                <span class="slider-button round"></span>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="selectedValue">Blog</span>
                                            <label class="switch-button">
                                                <input type="checkbox" ref="blog" v-on:click="selectedCheck('add_ons', 'blog')">
                                                <span class="slider-button round"></span>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="selectedValue">Forum</span>
                                            <label class="switch-button">
                                                <input type="checkbox" ref="forum" v-on:click="selectedCheck('add_ons', 'forum')">
                                                <span class="slider-button round"></span>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="selectedValue">Messaging</span>
                                            <label class="switch-button">
                                                <input type="checkbox" ref="messaging" v-on:click="selectedCheck('add_ons', 'messaging')">
                                                <span class="slider-button round"></span>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="selectedValue">Live Chat</span>
                                            <label class="switch-button">
                                                <input type="checkbox" ref="live_chat" v-on:click="selectedCheck('add_ons', 'live_chat')">
                                                <span class="slider-button round"></span>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="selectedValue">Gallery</span>
                                            <label class="switch-button">
                                                <input type="checkbox" ref="gallery" v-on:click="selectedCheck('add_ons', 'gallery')">
                                                <span class="slider-button round"></span>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="selectedValue">Contact Form</span>
                                            <label class="switch-button">
                                                <input type="checkbox" ref="contact" v-on:click="selectedCheck('add_ons', 'contact')">
                                                <span class="slider-button round"></span>
                                            </label>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-between">
                                            <span class="selectedValue">On-site Search</span>
                                            <label class="switch-button">
                                                <input type="checkbox" ref="search" v-on:click="selectedCheck('add_ons', 'search')">
                                                <span class="slider-button round"></span>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="selectedValue">Map Data / Geolocation</span>
                                            <label class="switch-button">
                                                <input type="checkbox" ref="map" v-on:click="selectedCheck('add_ons', 'map')">
                                                <span class="slider-button round"></span>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="selectedValue">Booking</span>
                                            <label class="switch-button">
                                                <input type="checkbox" ref="booking" v-on:click="selectedCheck('add_ons', 'booking')">
                                                <span class="slider-button round"></span>
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <span class="selectedValue">Social Media integration</span>
                                            <label class="switch-button">
                                                <input type="checkbox" ref="social_integration" v-on:click="selectedCheck('add_ons', 'social_integration')">
                                                <span class="slider-button round"></span>
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <span class="selectedValue">Analytics / Tracking</span>
                                            <label class="switch-button">
                                                <input type="checkbox" ref="analytics" v-on:click="selectedCheck('add_ons', 'analytics')">
                                                <span class="slider-button round"></span>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="module-footer d-flex justify-content-between">
                            <div class="key">
                                Cost:
                            </div>
                            <div class="value">
                                ${{costs.add_ons}}
                            </div>
                        </div>
                        </div>

<!--                        SEO-->
                        <div class="module-box">
                            <div class="module-header">
                                <h2>Search Engine Optimization</h2>
                            </div>
                            <div class="module-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="checkmark">Titles & Meta
                                            <input type="checkbox" checked="checked" ref="seo_meta" v-on:click="selectedCheck('seo', 'seo_meta')">
                                            <span></span>
                                        </label>
                                        <label class="checkmark">Keyword research
                                            <input type="checkbox" ref="seo_keyword" v-on:click="selectedCheck('seo', 'seo_keyword')">
                                            <span></span>
                                        </label>
                                        <label class="checkmark">+20 Advanced techniques
                                            <input type="checkbox" ref="seo_advanced" v-on:click="selectedCheck('seo', 'seo_advanced')">
                                            <span></span>
                                        </label>
                                    </div>

                                    <div class="col-md-6">

                                        <label class="checkmark">Header Tags
                                            <input type="checkbox" ref="seo_tags" v-on:click="selectedCheck('seo', 'seo_tags')">
                                            <span></span>
                                        </label>
                                        <label class="checkmark">Sitemap
                                            <input type="checkbox" ref="seo_sitemap" v-on:click="selectedCheck('seo', 'seo_sitemap')">
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="module-footer d-flex justify-content-between">
                            <div class="key">
                                Cost:
                            </div>
                            <div class="value">
                                ${{costs.seo}}
                            </div>
                        </div>
                        </div>


                        <!--                        Logo design-->
                        <div v-if="1===1" class="module-box">
                            <div class="module-header">
                                <h2>Logo design</h2>
                            </div>
                            <div class="module-body">
                                <div class="range-box-title">
                                    <div>
                                        No need
                                    </div>
                                    <div>
                                        Simple
                                    </div>
                                    <div>
                                        Custom
                                    </div>
                                </div>
                                <div class="range-box">
                                    <input type="range" class="custom-range full" v-model=logo_type :min=0 :max=2 step="1">
                                </div>

                            </div>
                            <div class="module-footer d-flex justify-content-between">
                                <div class="key">
                                    Cost:
                                </div>
                                <div class="value">
                                    ${{logoCost}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="sticky-top">
                        <div class="right-container">

                        <div class="result-box">
                            <h3>Your Quote</h3>
                            <div class="sub-cost d-flex justify-content-between">
                                <div class="key">Static Pages:</div>
                                <div class="value">${{pageCost}}</div>
                            </div>
                            <div class="sub-cost d-flex justify-content-between">
                                <div class="key">Add-ons:</div>
                                <div class="value">${{costs.add_ons}}</div>
                            </div>
                            <div class="sub-cost d-flex justify-content-between">
                                <div class="key">SEO:</div>
                                <div class="value">${{costs.seo}}</div>
                            </div>
                            <div class="sub-cost d-flex justify-content-between">
                                <div class="key">Logo design:</div>
                                <div class="value">${{logoCost}}</div>
                            </div>
                        </div>

                        <div class="total-cost d-flex justify-content-between">
                            <div class="key">
                                Total estimate:
                            </div>
                            <div class="value">
                                ${{totalEstimate}}
                            </div>
                        </div>

                        <div>
                            <button class="btn btn-order" @click="showModal = true">Order Your Website Now</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="showModal">
                <transition name="modal">
                    <div class="modal-mask">
                        <div class="modal-wrapper">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title">Website Quote</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" @click="reset()">&times;</span>
                                        </button>
                                    </div>
                                    <form @submit.prevent="submit">
                                        <div v-if="successModal">
                                            <div class="modal-body">
                                                <h5 class="success-text">
                                                    Your request successfully sent<br/>
                                                    We will contact you shortly.
                                                </h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" @click="reset()">Close <i class="fas fa-cancel"></i></button>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <div class="modal-body">
                                                <h5 class="modal-title">Please provide contact information</h5>

                                                <div class="form-group">
                                                    <input type="text"
                                                           v-model="form.name"
                                                           @change="updateError('name')"
                                                           class="form-control"
                                                           placeholder="Your name"
                                                           required>
                                                </div>
                                                <div v-if="this.errorHints.name" class="errorHints">{{this.errorHints.name}}</div>

                                                <div class="d-flex justify-content-between">
                                                    <div class="form-group">
                                                        <input type="tel" pattern="[0-9]{10,14}"
                                                               v-model="form.phone"
                                                               @change="updateError('phone')"
                                                               class="form-control"
                                                               placeholder="Phone"
                                                               style="width:95%"
                                                               required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="email"
                                                               v-model="form.email"
                                                               @change="updateError('email')"
                                                               class="form-control"
                                                               placeholder="E-mail"
                                                               required>
                                                    </div>
                                                </div>
                                                <div v-if="this.errorHints.phone" class="errorHints">{{this.errorHints.phone}}</div>
                                                <div v-if="this.errorHints.email" class="errorHints">{{this.errorHints.email}}</div>
                                                <div class="form-group">
                                                    <textarea v-model="form.note"
                                                              class="form-control"
                                                              placeholder="Some notes (Not necessary)..."
                                                              cols="30" rows="5">
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" >Send request <i class="fas fa-long-arrow-alt-right"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>


    </div>

</template>

<script src="./script.js"></script>
<style lang="scss" src="./style.scss"></style>