<template>
    <div>
        <h1>Companies</h1>

        <router-link class="waves-effect waves-light btn" to="/add-company">new company</router-link>

        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>

    </div>
</template>

<script>
    export default {
        name: "Companies.vue",
        mounted: function () {
            self = this;
            $(document).ready(function () {

                $('#example').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: 'api/company',
                        headers: {'Authorization': self.$store.state.token}
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'logo', name: 'logo'},
                        {data: 'website', name: 'website'},
                        {data: 'id', name: 'action'}
                    ],
                    "columnDefs": [
                        {
                            "targets": 3,
                            "data": "logo",
                            "render": function (url) {
                                if(url)
                                    return '<img width="100px" src="http://crm.my' + url + '"/>';
                                return '';
                            }
                        },
                        {
                            "targets": 4,
                            "data": "website",
                            "render": function (url) {
                                if(url)
                                    return '<a href="' + url + '"/>' + url + '</a>';
                                return '';
                            }
                        },
                        {
                            "targets": 5,
                            "data": "id",
                            "render": function (id) {
                                return '' +
                                    '<a class="btn-floating waves-light green" href="/#/company/'+id+'"><i class="material-icons">create</i></a>' +
                                    '<a class="btn-floating waves-light red" href="/#/remove-company/'+id+'"><i class="material-icons">delete</i></a>';
                            }
                        },
                    ]
                });
            });
        },
    }

</script>

<style scoped>

</style>
