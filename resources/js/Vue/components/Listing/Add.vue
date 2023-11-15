<template>
    <div>
        <flash-component></flash-component>
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-5">
                    <div class="right-sidebar box-container">
                        <div class="back">
                            <a href="/" title="Home">
                                <i class="fas fa-chevron-left"></i> Back Home
                            </a>
                        </div>
                        <h2>Create New Listing</h2>
                        <h6>Please fill inputs below:</h6>




                        <div class="form">
                            <form @submit.prevent="submit">

                                <div class="scrollable">

                                    <!--                Photo Upload-->
                                    <div
                                         class="file-upload bg-gray-100 border border-gray-300"
                                         @dragover="dragover"
                                         @dragleave="dragleave"
                                         @drop="drop">

                                        <input type="file" ref="fileInput" name="image"
                                               @change="onImageChange"
                                               accept=".pdf,.jpg,.jpeg,.png"
                                               class="input-file">

                                        <div @click="selectImage">
                                            Drag your <u>photo</u> here<br> or click to browse

                                                <div v-if="imageUrl" class="change-button" @click="selectImage">Change image <i class="fas fa-edit"></i></div>
                                        </div>

                                    </div>

                                    <CategoryList @on-item-selected="categorySelection = $event" @on-item-reset="categorySelection = {}" />


                                    <div class="form-group">
                                        <input type="text"
                                               v-model="form.title"
                                               @change="updateError('title')"
                                               class="form-control"
                                               placeholder=" "
                                               required>
                                        <span class="floating-label">Title</span>
                                    </div>
                                    <div v-if="errorHints.title" class="errorHints">{{this.errorHints.title}}</div>


                                    <div class="form-group">
                                        <input type="text"
                                               v-model="form.price"
                                               @change="updateError('price')"
                                               class="form-control"
                                               placeholder=" "
                                               required>
                                        <span class="floating-label">Price</span>
                                    </div>
                                    <div v-if="errorHints.price" class="errorHints">{{this.errorHints.price}}</div>



                                    <div class="form-group">
                                        <input type="text" style="position: relative"
                                               v-model="form.brand"
                                               @change="updateError('brand')"
                                               class="form-control"
                                               placeholder=" "
                                               required>
                                        <span class="floating-label">Brand</span>

                                    </div>
                                    <div v-if="errorHints.brand" class="errorHints">{{this.errorHints.brand}}</div>

                                    <div class="form-group">
                                        <textarea class="form-control" v-model="form.description" rows="10" placeholder=" "></textarea>
                                        <span class="floating-label">Description</span>
                                    </div>
                                    <div v-if="errorHints.description" class="errorHints">{{this.errorHints.description}}</div>

                                </div>
                                <button class="btn" >Create</button>
                            </form>
                        </div>


                    </div>
                </div>

                <div class="col-md-7">
                    <div class="preview box-container">
                        <h5>Preview</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="image">
                                    <img v-if="imageUrl" class="upload-preview" :src="imageUrl" @click="selectImage"/>
                                    <svg v-else><rect x="0" y="0" rx="20" style="fill:#c0c9d7;" /></svg>
                                </div>
                                <div class="description">
                                    <h6>Description</h6>
                                    <div v-if="this.form.description">{{this.form.description}}</div>
                                    <div v-else class="disabled">Lorem ipsum</div>
                                </div>
                            </div>
                            <div class="col-md-6 noPadding">
                                <h4 v-if="this.form.title" class="title">{{this.form.title}}</h4>
                                <h4 v-else class="title disabled">Title</h4>

                                <h6 v-if="this.form.price" class="title">${{this.form.price}}</h6>
                                <h6 v-else class="title disabled">Price</h6>

                                <h6 v-if="categorySelection.name" class="title">
                                    <i :class="['fas', 'fa-'+categorySelection.icon, 'dropdown-item-icon']"></i>
                                    {{categorySelection.name}}</h6>
                                <h6 v-else class="title disabled">Category</h6>

                                <h6 v-if="this.form.brand" class="title">Brand: {{this.form.brand}}</h6>

                                <div class="date disabled">Listed now</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</template>

<script src="./js/add.js"></script>
<style scoped lang="scss" src="./css/style.scss"></style>