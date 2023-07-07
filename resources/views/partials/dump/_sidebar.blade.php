<div id="sidebar-menu">
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>
        <li>
            <a href="{{route('admin-dashboard', ['account'=>$account])}}" class="waves-effect">
                <i class="bx bx-home-circle"></i>
                <span key="t-chat">Dashboard</span>
            </a>
        </li>
        <li class="menu-title" key="t-pages">Rentals</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-building-house"></i>
                <span key="t-layouts">Property</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('show-company-properties', ['account'=>$account])}}" key="t-layouts">All Properties</a></li>
                <li><a href="{{route('add-new-property', ['account'=>$account])}}" key="t-layouts">Add New Property</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-grid"></i>
                <span key="t-listing">Listing</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('show-add-new-listing-form', ['account'=>$account])}}" key="t-listing"> Add New Listing</a></li>
                <li><a href="{{route('show-property-listings', ['account'=>$account])}}" key="t-listing">Manage Listings</a></li>
                <li><a href="{{route('show-drafted-listings', ['account'=>$account])}}" key="t-listing">Drafted Listings</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bxs-key"></i>
                <span key="t-orders">Leasing</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('show-add-new-lease-application-form', ['account'=>$account])}}" key="t-orders"> Add New Application</a></li>
                <li><a href="{{route('show-lease-applications', ['account'=>$account])}}" key="t-orders"> Manage Applications</a></li>
                <li><a href="{{route('show-schedule-lease', ['account'=>$account])}}" key="t-orders">Schedule Lease</a></li>
                <li><a href="{{route('manage-leases', ['account'=>$account])}}" key="t-orders">Manage Leases</a></li>
            </ul>
        </li>
        <li class="menu-title" key="t-pages">Accounting</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-food-menu"></i>
                <span key="t-inflow">Income</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('new-invoice', ['account'=>$account])}}" key="t-inflow">  New Invoice</a></li>
                <li><a href="{{route('manage-invoices', ['account'=>$account])}}" key="t-inflow"> Manage Invoices</a></li>
                <li><a href="{{route('show-manage-receipts', ['account'=>$account])}}" key="t-inflow"> Manage Receipts</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-stats"></i>
                <span key="t-outflow">Expenses</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('show-new-bill-form', ['account'=>$account])}}" key="t-outflow">New Bill</a></li>
                <li><a href="{{route('manage-bills', ['account'=>$account])}}" key="t-outflow"> Manage Bills</a></li>
                <li><a href="{{route('show-make-direct-payment-form', ['account'=>$account])}}" key="t-outflow">New Payment</a></li>
                <li><a href="{{route('manage-payments', ['account'=>$account])}}" key="t-outflow"> All Payments</a></li>
            </ul>
        </li>
        <li class="menu-title" key="t-pages">People</li>
        <li>
            <a href="{{route('manage-tenants', ['account'=>$account])}}" class="waves-effect">
                <i class="bx bxs-user-detail"></i>
                <span key="t-chat">Tenants</span>
            </a>
        </li>
        <li>
            <a href="{{route('compose-sms', ['account'=>$account])}}" class="waves-effect">
                <i class="bx bxs-group"></i>
                <span key="t-chat">Prospects</span>
            </a>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bxs-contact"></i>
                <span key="t-ecommerce">Vendors</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('add-new-vendor', ['account'=>$account])}}" key="t-products">Add New Vendor</a></li>
                <li><a href="{{route('manage-vendors', ['account'=>$account])}}" key="t-product-detail">All Vendors</a></li>
            </ul>
        </li>
        @if($features->work_order != 1)
        <li class="menu-title" key="t-workOrder">Maintenance</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-wrench"></i>
                <span key="t-work-order">Work Request</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('manage-work-requests', ['account'=>$account])}}" key="t-work-order"> Manage Requests</a></li>
                <li><a href="{{route('show-create-new-work-request', ['account'=>$account])}}" key="t-work-order">New Request</a></li>
                <li><a href="{{route('show-add-new-lease-application-form', ['account'=>$account])}}" key="t-work-order"> My Requests</a></li>
            </ul>
        </li>
        <li>
            <a href="{{route('manage-work-orders', ['account'=>$account])}}" class="waves-effect">
                <i class="mdi mdi-treasure-chest"></i>
                <span key="t-chat">Work Orders</span>
            </a>
        </li>
        <li class="menu-title" key="t-pages">Bulk SMS</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-wallet"></i>
                <span key="t-wallet">Wallet</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('top-up', ['account'=>$account])}}" key="t-wallet">Fund Wallet</a></li>
                <li><a href="{{route('top-up-transactions', ['account'=>$account])}}" key="t-wallet">Transactions</a></li>
            </ul>
        </li>
        <li>
            <a href="{{route('compose-sms', ['account'=>$account])}}" class="waves-effect">
                <i class="bx bxs-edit-alt"></i>
                <span key="t-chat">Compose SMS</span>
            </a>
        </li>
        <li>
            <a href="{{route('schedule-sms', ['account'=>$account])}}" class="waves-effect">
                <i class="bx bx-timer"></i>
                <span key="t-chat">Schedule SMS</span>
            </a>
        </li>
        <li>
            <a href="{{route('phone-groups', ['account'=>$account])}}" class="waves-effect">
                <i class="bx bx-id-card"></i>
                <span key="t-chat">Phone Group</span>
            </a>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-shield-quarter"></i>
                <span key="t-ecommerce">Sender IDs</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('create-senders', ['account'=>$account])}}" key="t-products">Register ID</a></li>
                <li><a href="{{route('registered-senders', ['account'=>$account])}}" key="t-product-detail">All Sender IDs</a></li>
            </ul>
        </li>
        <li class="menu-title" key="t-pages">Communication</li>
        <li>
            <a href="{{route('manage-messages', ['account'=>$account])}}" class="waves-effect">
                <i class="bx bx-envelope"></i>
                <span key="t-chat">Messages</span>
            </a>
        </li>
        @endif
        @if($features->storage != 1)
        <li class="menu-title" key="t-pages">Cloud Storage</li>
        <li>
            <a href="{{route('cloud-storage', ['account'=>$account])}}" class="waves-effect">
                <i class="bx bx-cloud-upload"></i>
                <span key="t-chat">Documents</span>
            </a>
        </li>
        @endif
        <li class="menu-title">Reports & Logs</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-font-family"></i>
                <span key="t-crypto">Property Report</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="crypto-wallet.html" key="t-wallet">By Property</a></li>
                <li><a href="{{route('show-property-report-by-location', ['account'=>$account])}}" key="t-buy">By Location</a></li>
            </ul>
        </li>
        <li>
            <a href="{{route('show-application-report', ['account'=>$account])}}" class="waves-effect">
                <i class="bx bxs-collection"></i>
                <span key="t-chat">Applications</span>
            </a>
        </li>
        <li>
            <a href="{{route('show-income-report', ['account'=>$account])}}" class="waves-effect">
                <i class="bx bx-wallet-alt"></i>
                <span key="t-chat">Income</span>
            </a>
        </li>
        <li>
            <a href="{{route('show-expense-report', ['account'=>$account])}}" class="waves-effect">
                <i class="bx bx-wallet"></i>
                <span key="t-chat">Expenses</span>
            </a>
        </li>
        <li>
            <a href="{{route('cloud-storage', ['account'=>$account])}}" class="waves-effect">
                <i class="bx bx-mail-send"></i>
                <span key="t-chat">Bulk SMS</span>
            </a>
        </li>
        <li>
            <a href="{{route('show-audit-report', ['account'=>$account])}}" class="waves-effect">
                <i class="bx bx-sort-down"></i>
                <span key="t-chat">Audit Trail</span>
            </a>
        </li>
        <li class="menu-title" key="t-workForce">Team Members</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-user"></i>
                <span key="t-team">Members</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('add-new-team-member', ['account'=>$account])}}" key="t-team">Add New Member</a></li>
                <li><a href="{{route('manage-team', ['account'=>$account])}}" key="t-team">Manage Team</a></li>
                <li><a href="{{route('manage-team', ['account'=>$account])}}" key="t-team">Access Control</a></li>
            </ul>
        </li>
        <li class="menu-title">Settings</li>
        <li>
            <a href="{{route('show-settings', ['account'=>$account])}}" class="waves-effect">
                <i class="bx bx-cog"></i>
                <span key="t-chat">Settings</span>
            </a>
        </li>
    </ul>
</div>

