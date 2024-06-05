@extends('layouts/contentNavbarLayout')



@section('title',$title)



@section('page-script')

<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>

@endsection



@section('content')

<h4 class="py-1 mb-1">

    <span class="text-muted fw-light">{{$title}} </span>

</h4>

@include('admin.commonmessage')

<div class="container-xxl flex-grow-1 container-p-y">
            
            
<div class="row invoice-preview">
  <!-- Invoice -->
  <div class="col-xl-12 col-md-12 col-12 mb-md-0 mb-4">
    <div class="card invoice-preview-card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column">
          <div class="mb-xl-0 pb-3">
            <div class="d-flex svg-illustration align-items-center gap-2 mb-4">
                <!-- <span class="app-brand-logo demo">
                    <span style="color:#9055FD;">
                        <svg width="30" height="20" viewBox="0 0 250 196" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z" fill="currentColor"></path>
                            <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z" fill="black"></path>
                            <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z" fill="black"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z" fill="currentColor"></path>
                            <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z" fill="black"></path>
                            <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z" fill="black"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z" fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z" fill="white" fill-opacity="0.15"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z" fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z" fill="white" fill-opacity="0.3"></path>
                        </svg>
                    </span>
                </span> -->
                            <!-- <span class="h4 mb-0 app-brand-text fw-semibold">Materio</span> -->
                            </div>
                            <!-- <p class="mb-1">Office 149, 450 South Brand Brooklyn</p> -->
                            <!-- <p class="mb-1">San Diego County, CA 91905, USA</p> -->
                            <!-- <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p> -->
                          </div>
                          <div>
                            <h4 class="fw-medium text-capitalize pb-1 text-nowrap">#{{$order->order_id}}</h4>
                            <div class="mb-1">
                              <span>Order Date:</span>
                              <span>{{ $order->created_at }}</span>
                            </div>
                            <!-- <div>
                              <span>Date Due:</span>
                              <span>May 25, 2021</span>
                            </div> -->
                          </div>
                        </div>
                      </div>
                      <hr class="my-0">
                      <div class="card-body">
                        <div class="d-flex justify-content-between flex-wrap">
                          <div class="my-3 me-3">
                            <h6>Customer Detail:</h6>
                            <p class="mb-1">{{ $userDetail->name }}</p>
                            <!-- <p class="mb-1">Shelby Company Limited</p> -->
                            <p class="mb-1">{{ $userDetail->address }}</p>
                            <p class="mb-1">{{ $userDetail->mobile_no }}</p>
                            <p class="mb-0">{{ $userDetail->email }}</p>
                          </div>
                          <div class="my-3">
                            <h6>Order Summary:</h6>
                            <table>
                              <tbody>
                                <tr>
                                  <td class="pe-3">Total Net:</td>
                                  <td>{{ $order->totalnet.'.000' }}</td>
                                </tr>
                                <tr>
                                  <td class="pe-3">Total Gross:</td>
                                  <td>{{ $order->gross.'.000' }}</td>
                                </tr>
                                <tr>
                                  <td class="pe-3">Total Stone:</td>
                                  <td>{{ $order->stone.'.000' }}</td>
                                </tr>
                                <!-- <tr>
                                  <td class="pe-3">IBAN:</td>
                                  <td>ETD95476213874685</td>
                                </tr>
                                <tr>
                                  <td class="pe-3">SWIFT code:</td>
                                  <td>BR91905</td>
                                </tr> -->
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-borderless m-0">
                            <thead class="border-top">
                                <tr>
                                    <th>Id</th>
                                    <th>Order No</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Karat Id</th>
                                    <th>Size Id</th>
                                </tr>
                            </thead>
                          <tbody>

                            @if(!empty($OrderDetail))
                                @foreach($OrderDetail as $d => $cats)
                                    <tbody>
                                        <tr>
                                            <td>{{ $d+1 }}</td>
                                            <td>{{ $order->order_id }}</td>
                                            <td class="text-nowrap text-heading">{{ $cats->product ?? '' }}</td>
                                            <td>{{ $cats->qty ?? 0 }}</td>
                                            <td>{{ $cats->karat_name ?? '' }}</td>
                                            <td>{{ $cats->size_name ?? '' }}</td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            @endif     
                            <!-- <tr>
                              <td class="text-nowrap text-heading">Frest Admin Template</td>
                              <td class="text-nowrap">Angular Admin Template</td>
                              <td>$22</td>
                              <td>1</td>
                              <td>$22.00</td>
                            </tr> -->
                            
                          </tbody>
                        </table>
                      </div>
                      <hr class="my-0">
                     <!--  <div class="card-body">
                        <div class="row">
                          <div class="col-md-6 mb-md-0 mb-3">
                            <div>
                              <p class="mb-2">
                                <span class="me-1 text-heading">Salesperson:</span>
                                <span>Alfie Solomons</span>
                              </p>
                              <span>Thanks for your business</span>
                            </div>
                          </div>
                          <div class="col-md-6 d-flex justify-content-md-end mt-2">
                            <div class="invoice-calculations">
                              <div class="d-flex justify-content-between mb-2">
                                <span class="w-px-100">Subtotal:</span>
                                <h6 class="mb-0 pt-1">$5000.25</h6>
                              </div>
                              <div class="d-flex justify-content-between mb-2">
                                <span class="w-px-100">Discount:</span>
                                <h6 class="mb-0 pt-1">$00.00</h6>
                              </div>
                              <div class="d-flex justify-content-between mb-2">
                                <span class="w-px-100">Tax:</span>
                                <h6 class="mb-0 pt-1">$100.00</h6>
                              </div>
                              <hr>
                              <div class="d-flex justify-content-between">
                                <span class="w-px-100">Total:</span>
                                <h6 class="mb-0 pt-1">$5100.25</h6>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr class="my-0"> -->

                     <!--  <div class="card-body">
                        <div class="row">
                          <div class="col-12">
                            <span class="fw-medium">Note:</span>
                            <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                              projects. Thank You!</span>
                          </div>
                        </div>
                      </div> -->
                    </div>
                  </div>
                  <!-- /Invoice -->

                  <!-- Invoice Actions -->
                 <!--  <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                    <div class="card">
                      <div class="card-body">
                        <button class="btn btn-primary d-grid w-100 mb-3 waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#sendInvoiceOffcanvas">
                          <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="mdi mdi-send-outline scaleX-n1-rtl me-2"></i>Send Invoice</span>
                        </button>
                        <button class="btn btn-outline-secondary d-grid w-100 mb-3 waves-effect">
                          Download
                        </button>
                        <a class="btn btn-outline-secondary d-grid w-100 mb-3 waves-effect" target="_blank" href="#" onclick="window.print()">
                          Print
                        </a>
                        <a href="{{ route('order.edit',$order->id) }}" class="btn btn-outline-secondary d-grid w-100 mb-3 waves-effect">
                          Edit Invoice
                        </a>
                        <button class="btn btn-success d-grid w-100 waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#addPaymentOffcanvas">
                          <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="mdi mdi-currency-usd me-1"></i>Add Payment</span>
                        </button>
                      </div>
                    </div>
                  </div> -->
                  <!-- /Invoice Actions -->
                </div>

                <!-- Offcanvas -->
                <!-- Send Invoice Sidebar -->
                <div class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">
                  <div class="offcanvas-header mb-3">
                    <h5 class="offcanvas-title">Send Invoice</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body flex-grow-1">
                    <form>
                      <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="invoice-from" value="shelbyComapny@email.com" placeholder="company@email.com">
                        <label for="invoice-from">From</label>
                      </div>
                      <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="invoice-to" value="qConsolidated@email.com" placeholder="company@email.com">
                        <label for="invoice-to">To</label>
                      </div>
                      <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="invoice-subject" value="Invoice of purchased Admin Templates" placeholder="Invoice regarding goods">
                        <label for="invoice-subject">Subject</label>
                      </div>
                      <div class="form-floating form-floating-outline mb-4">
                        <textarea class="form-control" name="invoice-message" id="invoice-message" style="height: 190px;">Dear Queen Consolidated,
                          Thank you for your business, always a pleasure to work with you!
                          We have generated a new invoice in the amount of $95.59
                          We would appreciate payment of this invoice by 05/11/2021</textarea>
                        <label for="invoice-message">Message</label>
                      </div>
                      <div class="mb-4">
                        <span class="badge bg-label-primary rounded-pill">
                          <i class="mdi mdi-link-variant mdi-14px me-1"></i>
                          <span class="align-middle">Invoice Attached</span>
                        </span>
                      </div>
                      <div class="mb-3 d-flex flex-wrap">
                        <button type="button" class="btn btn-primary me-3 waves-effect waves-light" data-bs-dismiss="offcanvas">Send</button>
                        <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- /Send Invoice Sidebar -->
                <!-- Add Payment Sidebar -->
                <div class="offcanvas offcanvas-end" id="addPaymentOffcanvas" aria-hidden="true">
                  <div class="offcanvas-header mb-3">
                    <h5 class="offcanvas-title">Add Payment</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body flex-grow-1">
                    <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
                      <p class="mb-0">Invoice Balance:</p>
                      <p class="fw-medium mb-0">$5000.00</p>
                    </div>
                    <form>
                      <div class="input-group input-group-merge mb-4">
                        <span class="input-group-text">$</span>
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="invoiceAmount" name="invoiceAmount" class="form-control invoice-amount" placeholder="100">
                          <label for="invoiceAmount">Payment Amount</label>
                        </div>
                      </div>
                      <div class="form-floating form-floating-outline mb-4">
                        <input id="payment-date" class="form-control invoice-date flatpickr-input" type="text" readonly="readonly">
                        <label for="payment-date">Payment Date</label>
                      </div>
                      <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" id="payment-method">
                          <option value="" selected="" disabled="">Select payment method</option>
                          <option value="Cash">Cash</option>
                          <option value="Bank Transfer">Bank Transfer</option>
                          <option value="Debit Card">Debit Card</option>
                          <option value="Credit Card">Credit Card</option>
                          <option value="Paypal">Paypal</option>
                        </select>
                        <label for="payment-method">Payment Method</label>
                      </div>
                      <div class="form-floating form-floating-outline mb-4">
                        <textarea class="form-control" id="payment-note" style="height: 62px;"></textarea>
                        <label for="payment-note">Internal Payment Note</label>
                      </div>
                      <div class="mb-3 d-flex flex-wrap">
                        <button type="button" class="btn btn-primary me-3 waves-effect waves-light" data-bs-dismiss="offcanvas">Send</button>
                        <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
<!-- /Add Payment Sidebar -->
<!-- /Offcanvas -->

          </div>

@endsection