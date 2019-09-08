<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label>Invoice No</label>
            <input type="text" class="form-control" v-model="form.invoice_no" readonly>
            <p v-if="errors.invoice_no" class="error">@{{ errors.invoice_no[0] }}</p>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Customer Name</label>
            <input type="text" class="form-control" v-model="form.client">
            <p v-if="errors.client" class="error">@{{ errors.client[0] }}</p>
        </div>
        <div class="form-group">
            <label>Contact No</label>
            <input type="text" class="form-control" v-model="form.contact_no">
            <p v-if="errors.contact_no" class="error">@{{errors.contact_no[0]}}</p>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Invoice Date</label>
            <input type="date" class="form-control" v-model="form.invoice_date">
            <p v-if="errors.invoice_date" class="error">@{{ errors.invoice_date[0] }}</p>
        </div>
        <div class="form-group">
            <label>Customer Address</label>
            <textarea type="text" class="form-control" v-model="form.client_address"></textarea>
            <p v-if="errors.client_address" class="error">@{{errors.client_address[0]}}</p>
        </div>
    </div>

</div>
<hr>
<div v-if="errors.products_empty">
    <p class="alert alert-danger">@{{ errors.products_empty[0] }}</p>
    <hr>
</div>
<table class="table table-bordered table-form">
    <thead>
    <tr>
        <th>Description</th>
        <th>Rate</th>
        <th>Qty</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(product, index) in form.products">
        <td class="table-name" :class="{'table-error': errors[`products${index}name`]}">
            <textarea class="table-control form-control" v-model="product.name" ></textarea>
        </td>
        <td class="table-price" :class="{'table-error': errors[`products${index}price`]}">
            <input type="text" class="table-control form-control"  v-model="product.price">
        </td>
        <td class="table-qty" :class="{'table-error': errors[`products${index}qty`]}">
            <input type="text" class="table-control form-control" v-model="product.qty">
        </td>
        <td class="table-total">
            <span class="table-text">@{{ product.qty * product.price }}</span>
        </td>
        <td class="table-remove">
            <span @click="remove(product)" class="table-remove-btn btn btn-danger btn-sm"><i class="fa fa-times"></i></span>
        </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td class="table-empty" colspan="2">
            <span @click="addLine" class="table-add_line btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i> </span>
        </td>
        <td class="table-label">Sub Total</td>
        <td class="table-amount">@{{subTotal}}</td>
    </tr>
    <tr>
        <td class="table-empty" colspan="2"></td>
        <td class="table-label">Discount</td>
        <td class="table-amount" :class="{'table-error': errors.discount}">
            <input type="text" class="table-discount-input form-control" v-model="form.discount">
        </td>
    </tr>
    <tr>
        <td class="table-empty" colspan="2"></td>
        <td class="table-label">Grand Total</td>
        <td class="table-amount">@{{ grandTotal }}</td>
    </tr>
    </tfoot>
</table>
