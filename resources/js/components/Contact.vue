<template>
  <v-container>
    <v-row>
      <v-col cols="12">
          <template>
               <v-row>
                <v-dialog
                v-model="dialog"
                persistent
                max-width="600px"
                >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                    color="primary"
                    dark
                    v-bind="attrs"
                    v-on="on"
                    >
                    Add Contact
                    </v-btn>
                </template>
                    <v-card>
                        <v-card-title>
                        <span class="headline">Add Contact</span>
                        </v-card-title>
                        <v-card-text>
                        <v-container>
                        <form>
                            <v-row>
                            <v-col
                                cols="12"
                            >
                            <v-text-field v-model="contact.name"
                                label="Name*"
                                required
                                ></v-text-field>
                            </v-col>
                            <v-col
                                cols="12"
                            >
                            <v-text-field v-model="contact.bio"
                                label="Bio*"
                                required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                            <v-text-field v-model="contact.contact_no"
                                label="Contact*"
                                required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field v-model="contact.designation"
                                label="Designation*"
                                required
                                ></v-text-field>
                            </v-col>
                            </v-row>
                        </form>
                        </v-container>
                        </v-card-text>
                        <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="blue darken-1"
                            text
                            @click="dialog = false"
                        >
                            Close
                        </v-btn>
                        <v-btn
                            color="blue darken-1"
                            text
                            type="submit"
                            @click="submit"
                        >
                            Save
                        </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-row>

        </template>

        <template>
               <v-row>
                <v-dialog
                v-model="editDialog"
                persistent
                max-width="600px"
                >
                    <v-card>
                        <v-card-title>
                        <span class="headline">Add Contact</span>
                        </v-card-title>
                        <v-card-text>
                        <v-container>
                        <form>
                            <v-row>
                            <v-col
                                cols="12"
                            >
                            <v-text-field v-model="contact_edit.name"
                                label="Name"
                                required
                                ></v-text-field>
                            </v-col>
                            <v-col
                                cols="12"
                            >
                            <v-text-field v-model="contact_edit.bio"
                                label="Bio"
                                required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                            <v-text-field v-model="contact_edit.contact_no"
                                label="Contact"
                                required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field v-model="contact_edit.designation"
                                label="Designation"
                                required
                                ></v-text-field>
                            </v-col>
                            </v-row>
                        </form>
                        </v-container>
                        </v-card-text>
                        <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="blue darken-1"
                            text
                            @click="editDialog = false"
                        >
                            Close
                        </v-btn>
                        <v-btn
                            color="blue darken-1"
                            text
                            type="submit"
                            @click="update"
                        >
                            Save
                        </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-row>

          </template>

          <template>
            <v-simple-table>
            <template v-slot:default>
            <thead>
                <tr>
                    <th class="text-left">
                    #
                    </th>
                    <th class="text-left">
                    Name
                    </th>
                    <th class="text-left">
                    Bio
                    </th>
                    <th class="text-left">
                    Contact
                    </th>
                    <th class="text-left">
                    Designation
                    </th>
                    <th class="text-left">
                    Action
                    </th>
                </tr>
            </thead>
            <tbody v-for="contact in contacts" :key="contact.id">
                <tr>
                    <td>
                        {{contact.id}}
                    </td>
                    <td>
                        {{contact.name}}
                    </td>
                    <td>
                        {{contact.bio}}
                    </td>
                    <td>
                        {{contact.contact_no}}
                    </td>
                    <td>
                        {{contact.designation}}
                    </td>
                    <td>
                        <v-btn depressed color="primary" @click="openDialogEditContact(contact)"> Edit</v-btn>
                        <v-btn depressed color="error" @click.prevent="deleteContact(contact.id)"> Delete</v-btn>
                    </td>
                </tr>
            </tbody>
            </template>
            </v-simple-table>
          </template>

      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import Template from './Template.vue';
export default {
  components: { Template },
    name: 'Contact',
    created(){
        this.loadData();
    },
    methods:{
            loadData() {
            let url = this.url + '/api/contact/getContacts';
            axios.get(url).then(response => {
                this.contacts = response.data
                console.log(this.contacts);
            });
            },

            submit(){
            let url = this.url + '/api/contact/saveContact';
            axios.post(url, this.contact)
            .then(response => {
                this.dialog = false;
                this.contacts.push(response.data.data);
                this.contact.name = ""
                this.contact.bio = ""
                this.contact.contact_no = ""
                this.contact.designation = ""
            })
            .catch(function (error) {
                console.log(error);
            });

            },
            openDialogEditContact(contact){
                this.editDialog = true;
                this.contact_edit.name = contact.name;
                this.contact_edit.bio = contact.bio;
                this.contact_edit.contact_no = contact.contact_no;
                this.contact_edit.designation = contact.designation;
                this.selectedId = contact.id
            },
            update(){
                let url = this.url + `/api/contact/updateContact/${this.selectedId}`;
                axios.post(url, this.contact_edit)
                .then(response =>{
                    this.editDialog = false;
                    this.contact_edit.name = ""
                    this.contact_edit.bio = ""
                    this.contact_edit.contact_no = ""
                    this.contact_edit.designation = ""
                    this.loadData();
                })
                    .catch(function (error) {
                    console.log(error);
                });
            },
            deleteContact(id){
                let url = this.url + `/api/contact/deleteContact/${id}`;
                axios.delete(url).then(response => {
                    this.loadData();
                });
            }
        },
        mounted(){

        },
        data() {
            return{
                url: document.head.querySelector('meta[name="url"]').content,
                contacts: [],
                dialog: false,
                editDialog: false,
                contact_edit:{
                    name: "",
                    bio: "",
                    contact_no: "",
                    designation: ""
                },
                contact: {
                    name: "",
                    bio: "",
                    contact_no: "",
                    designation: ""
                },
                selectedId: null
                
            }
        }
    }
</script>