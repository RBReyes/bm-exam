<template>
    <div class="row">
    <nav
        class="page-breadcrumb d-flex align-items-center justify-content-between"
    >
        <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="/app-setting">Categories</a>
        </li>
        </ol>
        <span class="btn btn-primary" @click="addApp">Add Record</span>
    </nav>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="mb-4">List of City</h4>
            <table class="table table-borderless">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Banner</th>
                <th scope="col">Longitude</th>
                <th scope="col">Latitude</th>
                <th scope="col">Status</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr
                v-for="(x, index) in data.data"
                class="tr-text tr-bg"
                :key="x.id"
                >
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ x.name }}</td>
                <td>{{ x.description }}</td>
                <td>
                    <img
                    :src="'/storage/city/' + x.banner"
                    alt="image"
                    v-if="x.banner"
                    style="max-width: 200px; max-height: 50px"
                    />
                    <span v-if="!x.banner">no image</span>
                </td>
                <td>{{ x.longitude }}</td>
                <td>{{ x.latitude }}</td>
                <td>
                    <span
                    class="badge rounded-pill bg-primary"
                    v-if="x.status == 1"
                    >active</span
                    >
                    <span
                    class="badge rounded-pill bg-danger"
                    v-if="x.status == 2"
                    >inactive</span
                    >
                </td>
                <td>
                    <ul class="d-flex list-unstyled mb-0 justify-content-left">
                    <li class="me-2">
                        <a href="#" @click="update(x)"
                        ><svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-edit link-icon"
                        >
                            <path
                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                            ></path>
                            <path
                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                            ></path></svg
                        ></a>
                    </li>
                    </ul>
                </td>
                </tr>
            </tbody>
            </table>
        </div>
        <Pagination
            @pageClicked="loadAppSetting"
            v-bind="{
            _lastPage: data.last_page,
            _page: page,
            _total: data.total,
            _per_page: data.per_page,
            }"
            v-if="data.data"
        />
        </div>
    </div>
    <!-- modal add-->
    <div
        class="modal modal-blur fade"
        id="modal-add"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Add Record</h4>
                <form class="forms-sample">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                    <label for="phoneno" class="form-label"> Name</label>
                    <input
                        type="text"
                        class="form-control"
                        autocomplete="off"
                        placeholder="Name"
                        v-model="app.name"
                    />
                    </div>
                    <div class="col-lg-6 mb-3">
                    <label for="phoneno" class="form-label"> Description</label>
                    <input
                        type="text"
                        class="form-control"
                        autocomplete="off"
                        placeholder="Description"
                        v-model="app.description"
                    />
                    </div>
                    <div class="col-lg-6 mb-3">
                    <label for="upload" class="form-label">Banner</label>
                    <input
                        class="form-control"
                        accept="image/x-png, image/gif, image/jpeg"
                        @change="onFilePicture"
                        type="file"
                    />
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="phoneno" class="form-label"> Longitude</label>
                        <input
                            type="text"
                            class="form-control"
                            autocomplete="off"
                            placeholder="Longitude"
                            v-model="app.longitude"
                        />
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="phoneno" class="form-label"> Latitude</label>
                        <input
                            type="text"
                            class="form-control"
                            autocomplete="off"
                            placeholder="Latitude"
                            v-model="app.latitude"
                        />
                    </div>
                    <div class="col-lg-6 mb-3">
                    <label for="exampleFormControlSelect1" class="form-label"
                        >Select Status</label
                    >
                    <select
                        class="form-select"
                        id="exampleFormControlSelect1"
                        v-model="app.status"
                    >
                        <option selected="" disabled="">Select Status</option>
                        <option value="1">active</option>
                        <option value="2">inactive</option>
                    </select>
                    </div>
                    <div class="text-center">
                    <button
                        type="button"
                        @click="saveApp"
                        class="btn btn-primary"
                    >
                        <span v-if="!app.id">Add Setting</span>
                        <span v-if="app.id">Update Setting</span>
                    </button>
                    </div>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
    <!-- end modal add -->
    </div>
    </template>
    
    <script>
    import axios from "axios";
    import Pagination from "../../components/Pagination.vue";
    import Swal from "sweetalert2";
    export default {
    components: {
    Pagination,
    },
    data() {
    return {
        errors: "",
        data: "",
        datax: "",
        app: {
        id: "",
        name: "",
        description: "",
        banner: "",
        longitude: "",
        latitude:"",
        status: "",
        },
        page: 1,
        trig: "load",
        errorClass: "is-invalid",
    };
    },
    created() {
    this.trig = "load";
    this.loadAppSetting();
    },
    methods: {
    onFilePicture(e) {
        this.app.banner = e.target.files[0];
        const fileType =
        this.app.banner && this.app.banner["type"].split("/")[0] === "image";
        if (fileType == false) {
        console.log("Please select image only", "System");
        this.app.banner = "";
        return;
        }
    },
    
   
    
    update(x) {
        $("#modal-add").modal("show");
        this.app = x;
        this.app.add_banner = "";
        this.app.banner = "";
    },
    banner(e) {
        var files = e.target.files || e.dataTransfer.files;
        if (!files.length) this.app.banner = files[0];
    },
    addApp() {
        (this.app = {
        id: "",
        name: "",
        description: "",
        banner: "",
        add_banner: "",
        status: "",
        }),
        $("#modal-add").modal("show");
    },
    saveApp() {
        var k = "Do you want to save this city?";
        if (this.app.id) {
        k = "Do you want to update this city?";
        }
    
        Swal.fire({
        title: k,
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: "Yes",
        }).then((result) => {
        if (result.isConfirmed) {
            let formData = new FormData();
            formData.append("banner", this.app.banner);
            formData.append("add_banner", this.app.add_banner);
            formData.append("name", this.app.name);
            formData.append("longitude", this.app.longitude);
            formData.append("description", this.app.description);
            formData.append("latitude", this.app.latitude);
            formData.append("status", this.app.status);
            formData.append("id", this.app.id);
    
            const config = {
            headers: {
                "content-type": "multipart/form-data",
            },
            };
    
            this.datax = formData;
    
            axios
            .post("/admin/save-city", this.datax, config)
            .then((response) => {
                if (response.data.status) {
                $("#modal-add").modal("hide");
                this.trig = "load";
                this.loadAppSetting();
    
                Swal.fire("Good job!", response.data.message, "success");
                } else {
                this.errors = response.data.errors;
                Swal.fire(
                    "Oops Check your data!!!",
                    response.data.message,
                    "error"
                );
                this.trig = "load";
                this.loadAppSetting();
                }
            });
        } else if (result.isDenied) {
            return;
        }
        });
    },
    async loadAppSetting(page = 1) {
        this.page = page;
        let res = await axios.get("/admin/get-city", {
        params: { page: page, trig: this.trig, id: this.app.id },
        });
        this.data = res.data.data;
    },
    },
    };
    </script>