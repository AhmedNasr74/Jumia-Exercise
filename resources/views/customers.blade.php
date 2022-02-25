@extends('app')
@section('content')
    <div class="row mt-3">
        <h1 class="mb-3">Phone Numbers</h1>
        <form class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col-12">
                <select v-model="filter.country" name="country" class="form-select" id="inlineFormSelectPref">
                    <option value="">Select Country</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Uganda">Uganda</option>
                </select>
            </div>
            <div class="col-12">
                <select v-model="filter.state" name="state" class="form-select" id="inlineFormSelectPref">
                    <option value="all">All phone numbers</option>
                    <option value="valid">Valid phone numbers</option>
                    <option value="invalid">Invalid phone numbers</option>
                </select>
            </div>

        </form>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="col-2 mb-2">
                <select v-model="filter.per_page" name="state" class="form-select" id="inlineFormSelectPref">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="100">100</option>
                </select>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">Country</th>
                    <th scope="col">State</th>
                    <th scope="col">Country Code</th>
                    <th scope="col">Phone num.</th>
                </tr>
                </thead>
                <tbody>

                <tr v-if="loading">
                    <td class="text-center" colspan="4">Loading................</td>
                </tr>
                <tr v-else v-for="(customer) in customers_data.data">
                    <td>@{{ customer.country }}</td>
                    <td>@{{ customer.state }}</td>
                    <td>@{{ customer.country_code }}</td>
                    <td>@{{ customer.phone }}</td>
                </tr>

                </tbody>
            </table>
            <pagination :data="customers_data" @pagination-change-page="getCustomersPagination">
            </pagination>
        </div>
    </div>
@endsection
@push('script')
    <script>
        let app = new Vue({
            components: {
                pagination: window['laravel-vue-pagination']
            },
            el: '#app',
            data() {
                return {
                    loading:false,
                    filter: {
                        country: '',
                        state: 'all',
                        page: 1,
                        per_page: 5,
                    },
                    customers_data: {}
                }
            },
            mounted() {
                this.loadCustomersData()
            },
            watch: {
                filter: {
                    deep: true,
                    handler(val) {
                        this.loadCustomersData()
                    }
                }
            },
            methods: {
                loadCustomersData() {
                    this.loading=true;
                    axios.get('/customers', {params: this.filter}).then(response => {
                        this.customers_data = response.data.customers
                    }).catch(error=> {
                        new swal({
                            title: "Something Went Wrong!",
                            text:'Try Refresh',
                            icon: "warning",
                            dangerMode: true,
                            buttons: {
                                cancel: true,
                                confirm: true,
                            },
                        }).then((refresh) => {
                            if (refresh) {
                                window.location.reload()
                            }
                        });

                    })
                        .finally(()=>{
                        this.loading=false;
                    })
                },
                getCustomersPagination(page=1){
                    this.filter.page=page;
                }
            }
        })
    </script>
@endpush
