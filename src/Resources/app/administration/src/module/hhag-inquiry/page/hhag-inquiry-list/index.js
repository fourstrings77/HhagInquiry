import template from './hhag-inquiry-list.html';
import './hhag-inquiry-list.scss'

const { Mixin } = Shopware;
const { Criteria } = Shopware.Data;

Shopware.Component.register("hhag-inquiry-list", {
    template,

    inject: [
        'repositoryFactory',
        'acl',

    ],
    mixins: [
        Mixin.getByName('notification')
    ],

    data() {
        return {
            inquiries: null,
            isLoading: false,
        }
    },

    metaInfo() {
        return {
            title: this.$createTitle(),
        }
    },

    computed:{
        inquiryRepository(){
            return this.repositoryFactory().create('inquiry')
        },

        inquiryColumns() {
            return this.getInquiryColumns();
        },

        inquiryCriteria() {
            const criteria = new Criteria();

            criteria.addAssociation('inquiryState');

            return criteria;
        }
    },

    created() {
        return Promise.resolve();
    },
    methods: {

        async getInquiryList(){
                this.isLoading = true;

                try{
                    const inquiries = this.inquiryRepository().search();

                    this.inquiries = [{}];

                } catch(error){
                    this.isLoading = false;
                }

        },

        getInquiryColumns(){
           return [
               {
                   property: 'inquiryNumber',
                   label: 'hhag-inquiry.list.colInquiryNumber',
                   allowResize: true,
                   routerLink: 'hhag.inquiry.detail',
                   primary: true
               },

               {
                   property: 'firstName',
                   dataIndex: 'lastName,firstName',
                   label: 'hhag-inquiry.list.colInquiryName',
                   allowResize: true,
               },
               {
                   property: 'inquiryDate',
                   label: 'hhag-inquiry.list.colInquiryDate',
                   allowResize: true,
               },
               {
                   property: 'inquiryState',
                   label: 'hhag-inquiry.list.colInquiryState',
                   allowResize: true,
               }
           ];
        }
    }
})