var app = new Vue({
    el: '#invoice',
    data: {
        isProcessing: false,
        form: {},
        errors: {},
        message: '',
    },
    created: function () {
        Vue.set(this.$data, 'form', _form);
    },
    methods: {
        addLine: function() {
            this.form.products.push({name: '', price: 0, qty: 1});
        },
        remove: function(product) {
            this.form.products.splice(product, 1);
        },
        create: function() {
            this.isProcessing = true;
            this.$http.post('./invoices', this.form)
                .then(function(response) {
                    if(response.data.created) {
                        window.location = './show/' + response.data.id;
                    } else {
                        this.isProcessing = false;
                    }
                })
                .catch(function(response) {
                    this.isProcessing = false;
                    Vue.set(this.$data, 'errors', response.data);
                })
        },
        update: function() {
            this.isProcessing = true;
            this.$http.put('./invoices/' + this.form.id, this.form)
                .then(function(response) {
                    if(response.data.updated) {
                        window.location = '../show/' + response.data.id;
                    } else {
                        this.isProcessing = false;
                    }
                })
                .catch(function(response) {
                    this.isProcessing = false;
                    Vue.set(this.$data, 'errors', response.data);
                })
        }
    },
    computed: {
        subTotal: function() {
            return this.form.products.reduce(function(carry, product) {
                return carry + (parseFloat(product.qty) * parseFloat(product.price));
            }, 0);
        },
        grandTotal: function() {
            return this.subTotal - parseFloat(this.form.discount);
        }
    }
})