/* Estilos para la especie vacuno */

/* globales*/

:root {
--primary-color: #e0e8dc;
--secondary-color: #4a5d23;
--background-color: #f8f9fa;
--card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
* {
  box-sizing: border-box;
  margin: 0rem;
  padding: 0;

}
body {
  background-color: var(--background-color);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 0.5;
  color: #333;
  padding: 10px;
}
h6 {
  font-size: 0.8rem;
  text-align: center;
  color: red;
}

/* Navbar */

.nav-icons-container {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px 0;
    gap: 50px;
    flex-wrap: wrap;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    margin: 10px 0;
}
.scroll-Icons-container{
  width: 90%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px 0;
  gap: 10px;
  flex-wrap: wrap;
}

.icon-nav-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 0px;
    padding-top: 0px;
    margin-top: 0px;
    padding-bottom: 0px;
    margin-bottom: 0px;
    padding-left: 0px;
    margin-left: 0px;
    padding-right: 0px;
    margin-right: 0px;
}

.icon-button {
    background: white;
    border: 1px solid #ccc;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    padding: 0;
}

.nav-icon {
    width: 24px;
    height: 24px;
    transition: all 0.3s ease;
}

.icon-button:hover .nav-icon {
    transform: scale(1.2);
}

.icon-button:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Tooltip Styles */
.icon-button::before {
    content: attr(data-tooltip);
    position: absolute;
    bottom: -30px;
    left: 50%;
    transform: translateX(-50%);
    padding: 4px 8px;
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    font-size: 12px;
    border-radius: 4px;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.icon-button:hover::before {
    opacity: 1;
    visibility: visible;
}

.container {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    gap: 0.1rem;
    padding: 0.3rem;
}


/* Custom tooltip styling */
.tooltip {
    font-size: 1rem !important;
}

.tooltip-inner {
    max-width: 200px;
    padding: 0.25rem 0.5rem;
    font-size: 1rem;
    line-height: 1.2;
}

.table-section {
    margin-bottom: 40px;
}
.section-title {
    background-color: #f8f9fa;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    font-weight: bold;
}
.page-title {
    text-align: center;
    margin-bottom: 30px;
    font-size: 48px;
    font-weight:bolder;
    color: #83956e;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    text-transform: uppercase;
}
.dtr-details {
  width: 100%;
}

.section-title {
  background-color: #83956e;
  color: white;
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 5px;
  font-weight: bold;
}

.sub-section-title {
  color: #689260;
  font-weight: bold;
  margin-bottom: 15px;
}

.btn-primary {
  background-color: #83956e;
  border-color: #83956e;
}

.btn-primary:hover {
  background-color: #689260;
  border-color: #689260;
}


/* Active/selected page styling */
.dataTables_wrapper .paginate_button.current,
.dataTables_wrapper .paginate_button.current:hover,
.page-item.active .page-link,
.pagination > .active > a,
.pagination > .active > span,
.pagination > .active > a:hover,
.pagination > .active > span:hover,
.pagination > .active > a:focus,
.pagination > .active > span:focus {
  background-color: #689260 !important;
  border-color: #689260 !important;
  color: white !important;
}

/* Inactive pagination links styling */
.dataTables_wrapper .paginate_button,
.page-link,
.pagination > li > a,
.pagination > li > span {
  color: #999 !important; /* Light grey color */
}

.dataTables_wrapper .paginate_button:hover {
  background: #689260 !important;
  color: white !important;
  border: 1px solid #689260 !important;
}

.header-container {
  display: flex;
  justify-content: center;
  margin-bottom: 30px;
}
.animal-name {
  text-align: center;
  color: #689260;
  font-size: 24px;
  margin-bottom: 20px;
  font-weight: bold;
}

.table td .btn-primary {
  margin-right: 10px;
}
.back-btn {
  position: fixed;
  top: 20px;
  left: 20px;
  font-size: 64px;
  color: #83956e;
  text-decoration: none;
  transition: color 0.3s;
  z-index: 10000;
}
.back-btn:hover {
  color: #689260;
}
.back-to-top {
  position: fixed;
  bottom: 30px;
  right: 30px;
  width: 45px;
  height: 45px;
  background-color: #ffffff;
  border: 2px solid #4caf50;
  border-radius: 50%;
  display: none;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  z-index: 9999;
  transition: all 0.3s ease;
  box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}
.arrow-up {
  width: 0;
  height: 0;
  border-left: 8px solid transparent;
  border-right: 8px solid transparent;
  border-bottom: 12px solid #4caf50;
}
.back-to-top:hover {
  background-color: #4caf50;
  transform: translateY(-5px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}
.back-to-top:hover .arrow-up {
  border-bottom-color: #ffffff;
}
/* Table responsive styling */
.table-responsive {
    width: 100%;
    margin-bottom: 1rem;
    overflow-x: hidden; /* Prevent horizontal scrolling */
}

/* DataTable responsive styling */
.dataTables_wrapper table {
    width: 100% !important;
    table-layout: fixed;
}

.dataTables_wrapper th,
.dataTables_wrapper td {
    white-space: normal; /* Allow text wrapping */
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Child row styling for responsive view */
.dtr-details {
    width: 100%;
}

/* Plus/minus icons for expanding rows */
table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control,
table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control {
    position: relative;
    padding-left: 30px;
    cursor: pointer;
}

/* Toggle arrow styling */
table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control:before,
table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control:before {
    content: '►';
    background-color: transparent;
    color: #83956e;
    border: none;
    box-shadow: none;
    font-size: 0.8rem;
}

table.dataTable.dtr-inline.collapsed > tbody > tr.parent > td.dtr-control:before,
table.dataTable.dtr-inline.collapsed > tbody > tr.parent > th.dtr-control:before {
    content: '▼';
    background-color: transparent;
    color: #83956e;
}

/* Mobile styles */
@media screen and (max-width: 480px) {
    .dataTables_wrapper th,
    .dataTables_wrapper td {
        display: block;
        width: 100%;
    }
    
    /* Table font sizes for mobile */
    table.dataTable thead th,
    .dataTables_wrapper thead th {
        font-size: 0.8rem !important;
    }

    table.dataTable tbody td,
    .dataTables_wrapper tbody td {
        font-size: 0.7rem !important;
    }
    
    .desktop-table {
        display: none;
    }
    .mobile-table {
        display: block;
    }
}

/* Tablets */

@media (max-width: 768px) {
  .dataTables_wrapper th,
  .dataTables_wrapper td {
      max-width: 120px; /* Medium max width for tablets */
  }
  .icon-nav-container {
    gap: 15px;
    flex-wrap: wrap;
  }
  .icon-button {
    width: 40px;
    height: 40px;
  }
  .nav-icon {
    width: 20px;
    height: 20px;
  }
  .table td .btn-primary {
    margin-right: 5px;
  }
  .back-to-top {
    bottom: 20px;
    right: 20px;
    width: 40px;
    height: 40px;
  }
  .arrow-up {
    border-left-width: 6px;
    border-right-width: 6px;
    border-bottom-width: 10px;
  }
  .back-btn {
    font-size: 56px;
    left: 15px;
    top: 15px;
  }
  .page-title {
    font-size: 36px;
  }
  .animal-name {
    font-size: 20px;
  }
}

/* Cards Container Grid Layout */
.cards-container {
    display: grid;
    gap: 1rem;
    padding: 1rem;
    width: 100%;
}

/* Laptops and larger screens (5 cards per row) */
@media screen and (min-width: 1024px) {
    .cards-container {
        grid-template-columns: repeat(5, 1fr);
    }
}

/* Tablets (4 cards per row) */
@media screen and (min-width: 768px) and (max-width: 1023px) {
    .cards-container {
        grid-template-columns: repeat(4, 1fr);
    }
}

/* Mobile (1 card per row) */
@media screen and (max-width: 767px) {
    .cards-container {
        grid-template-columns: 1fr;
    }
}

/* Action Buttons Container */
.action-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    width: 100%;
    padding: 10px;
    margin-top: 10px;
}

/* Individual Action Button */
.action-btn {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    border: none;
    background-color: #ffffff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Button Icons */
.action-btn i {
    font-size: 14px;
    transition: transform 0.3s ease;
}

/* Delete Button Specific Styling */
.action-btn.delete-btn i {
    color: #dc3545; /* Red color for trash icon */
}

.action-btn.delete-btn:hover {
    background-color: #fff5f5;
}

/* Hover Effects */
.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.action-btn:hover i {
    transform: scale(1.1);
}

/* Active State */
.action-btn:active {
    transform: translateY(0);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* DataTable base styling */
#vacunoTable {
    width: 100% !important;
    background: white;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 4px;
    overflow: hidden;
}

#vacunoTable thead th {
    text-align: center !important;
    vertical-align: middle !important;
    background-color: #f8f9fa;
    color: #495057;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    padding: 12px 15px;
    border-bottom: 2px solid #83956e;
    white-space: nowrap;
}

#vacunoTable tbody td {
    text-align: center !important;
    vertical-align: middle !important;
    padding: 12px 15px;
    border-bottom: 1px solid #e9ecef;
    font-size: 0.875rem;
    color: #495057;
}

#vacunoTable tbody tr:hover {
    background-color: #f8f9fa;
}

/* Search and Length Menu Styling */
.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 8px 12px;
    margin-left: 8px;
    width: 200px;
    font-size: 0.875rem;
}

.dataTables_wrapper .dataTables_length select {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 6px 24px 6px 12px;
    margin: 0 8px;
    font-size: 0.875rem;
}

/* Pagination Styling */
.dataTables_wrapper .dataTables_paginate {
    margin-top: 15px;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 6px 12px;
    margin: 0 3px;
    border-radius: 4px;
    border: 1px solid #ddd;
    background: white;
    color: #495057 !important;
    font-size: 0.875rem;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #83956e !important;
    color: white !important;
    border-color: #83956e;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    background: #83956e !important;
    color: white !important;
    border-color: #83956e;
    font-weight: 600;
}

/* Info Text Styling */
.dataTables_wrapper .dataTables_info {
    color: #6c757d;
    font-size: 0.875rem;
    padding-top: 15px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dataTables_wrapper .dataTables_filter input {
        width: 150px;
    }

    #vacunoTable thead th,
    #vacunoTable tbody td {
        padding: 8px 10px;
        font-size: 0.8rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 4px 8px;
        font-size: 0.8rem;
    }
}

/* Striped Rows */
#vacunoTable tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.02);
}

/* Loading State */
#vacunoTable.dataTable.processing tbody tr {
    opacity: 0.5;
}

/* Search Highlight */
#vacunoTable tbody tr.highlight {
    background-color: #fff3cd;
}

/* Keep toggle arrow column left-aligned */
#vacunoTable tbody td.dtr-control {
    text-align: left !important;
}

/* Heading styles */
h3 {
    color: white !important;
    background-color: #83956e;
    padding: 10px 20px;
    border-radius: 5px;
    margin: 20px 0;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 1.2rem;
    text-align: center;
    width: 100%;
    display: block;
}

/* Common DataTable styling for all tables */
.dataTables_wrapper {
    padding: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    margin-bottom: 30px;
}

/* Base table styling */
table.dataTable {
    width: 100% !important;
    background: white;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 4px;
    overflow: hidden;
    margin-top: 15px !important;
    margin-bottom: 15px !important;
}

/* Header styling */
table.dataTable thead th {
    text-align: center !important;
    vertical-align: middle !important;
    background-color: #f8f9fa;
    color: #495057;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    padding: 12px 15px;
    border-bottom: 2px solid #83956e !important;
    white-space: nowrap;
}

/* Cell styling */
table.dataTable tbody td {
    text-align: center !important;
    vertical-align: middle !important;
    padding: 12px 15px;
    border-bottom: 1px solid #e9ecef;
    font-size: 0.875rem;
    color: #495057;
}

/* Row hover effect */
table.dataTable tbody tr:hover {
    background-color: rgba(131, 149, 110, 0.05) !important;
}

/* Striped rows */
table.dataTable tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.02);
}

/* Toggle arrow styling */
table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control,
table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control {
    position: relative;
    padding-left: 30px !important;
    cursor: pointer;
}

table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control:before,
table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control:before {
    content: '►';
    background-color: transparent;
    color: #83956e;
    border: none;
    box-shadow: none;
    font-size: 0.8rem;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    position: absolute;
}

table.dataTable.dtr-inline.collapsed > tbody > tr.parent > td.dtr-control:before,
table.dataTable.dtr-inline.collapsed > tbody > tr.parent > th.dtr-control:before {
    content: '▼';
}

/* Search and Length Menu Styling */
.dataTables_filter {
    margin-bottom: 1rem;
}

.dataTables_filter label {
    font-weight: 500;
    color: #495057;
}

.dataTables_filter input {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 8px 12px;
    margin-left: 8px;
    width: 200px;
    font-size: 0.875rem;
}

.dataTables_filter input:focus {
    border-color: #83956e;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(131, 149, 110, 0.25);
}

.dataTables_length label {
    font-weight: 500;
    color: #495057;
}

.dataTables_length select {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 6px 24px 6px 12px;
    margin: 0 8px;
    font-size: 0.875rem;
}

/* Pagination Styling */
.dataTables_paginate {
    margin-top: 1rem;
    padding-top: 0.5rem;
    border-top: 1px solid #eee;
}

.dataTables_paginate .paginate_button {
    padding: 6px 12px;
    margin: 0 3px;
    border-radius: 4px;
    border: 1px solid #ddd !important;
    background: white !important;
    color: #495057 !important;
    font-size: 0.875rem;
}

.dataTables_paginate .paginate_button:hover {
    background: #83956e !important;
    color: white !important;
    border-color: #83956e !important;
}

.dataTables_paginate .paginate_button.current,
.dataTables_paginate .paginate_button.current:hover {
    background: #83956e !important;
    color: white !important;
    border-color: #83956e !important;
    font-weight: 600;
}

.dataTables_paginate .paginate_button.disabled {
    color: #6c757d !important;
    cursor: not-allowed;
    background: #f8f9fa !important;
    border-color: #ddd !important;
}

/* Info text styling */
.dataTables_info {
    color: #6c757d;
    font-size: 0.875rem;
    padding-top: 1rem;
}

/* Child row styling */
table.dataTable > tbody > tr.child ul.dtr-details {
    display: block;
    list-style-type: none;
    margin: 0;
    padding: 0.5rem;
}

table.dataTable > tbody > tr.child ul.dtr-details > li {
    border-bottom: 1px solid #efefef;
    padding: 0.5em 0;
}

table.dataTable > tbody > tr.child ul.dtr-details > li:last-child {
    border-bottom: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .dataTables_filter input {
        width: 150px;
    }
    
    table.dataTable thead th,
    table.dataTable tbody td {
        padding: 8px 10px;
        font-size: 0.8rem;
    }
    
    .dataTables_paginate .paginate_button {
        padding: 4px 8px;
        font-size: 0.8rem;
    }
    
    .dataTables_length,
    .dataTables_filter {
        text-align: left;
        float: none;
    }
}

/* Hide dtr-control for tablet and desktop */
@media (min-width: 769px) {
    .dtr-control {
        display: none !important;
    }
}

/* Show dtr-control only on mobile */
@media (max-width: 768px) {
    .dtr-control {
        display: table-cell !important;
    }
    
    /* Style for the toggle control */
    table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control:before,
    table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control:before {
        content: '►';
        background-color: transparent;
        color: #83956e;
        border: none;
        box-shadow: none;
        font-size: 0.8rem;
    }

    table.dataTable.dtr-inline.collapsed > tbody > tr.parent > td.dtr-control:before,
    table.dataTable.dtr-inline.collapsed > tbody > tr.parent > th.dtr-control:before {
        content: '▼';
    }
}

/* Ensure pagination controls are visible */
.dataTables_paginate {
    display: block !important;
    margin-top: 1rem !important;
    padding-top: 0.5rem !important;
}

.dataTables_paginate .paginate_button {
    display: inline-block !important;
    padding: 0.5em 1em !important;
    margin: 0 0.2em !important;
    border: 1px solid #ddd !important;
    border-radius: 4px !important;
    cursor: pointer !important;
}

.dataTables_paginate .paginate_button.current {
    background-color: #83956e !important;
    color: white !important;
    border-color: #83956e !important;
}

.dataTables_paginate .paginate_button:hover {
    background-color: #83956e !important;
    color: white !important;
    border-color: #83956e !important;
}

/* Ensure length menu is visible */
.dataTables_length {
    display: block !important;
    margin-bottom: 1rem !important;
}

/* DataTables wrapper */
.dataTables_wrapper {
    margin: 20px 0;
    clear: both;
}

/* Search box */
.dataTables_filter {
    float: right;
    margin-bottom: 10px;
}

.dataTables_filter input {
    margin-left: 0.5em;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Length changing */
.dataTables_length {
    float: left;
    margin-bottom: 10px;
}

.dataTables_length select {
    margin: 0 0.5em;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Pagination */
.dataTables_paginate {
    float: right;
    margin-top: 10px;
}

.dataTables_paginate .paginate_button {
    padding: 5px 10px;
    margin: 0 2px;
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: pointer;
}

.dataTables_paginate .paginate_button.current {
    background: #83956e;
    color: white;
    border-color: #83956e;
}

.dataTables_paginate .paginate_button:hover {
    background: #83956e;
    color: white !important;
    border-color: #83956e;
}

/* Info display */
.dataTables_info {
    float: left;
    margin-top: 10px;
}

/* Table */
table.dataTable {
    width: 100% !important;
    margin: 10px 0 !important;
    clear: both;
}

/* Responsive display */
table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control:before,
table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control:before {
    content: '►';
    background-color: transparent;
    color: #83956e;
    border: none;
    box-shadow: none;
}

table.dataTable.dtr-inline.collapsed > tbody > tr.parent > td.dtr-control:before,
table.dataTable.dtr-inline.collapsed > tbody > tr.parent > th.dtr-control:before {
    content: '▼';
}

/* Mobile responsiveness */
@media screen and (max-width: 767px) {
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        float: none;
        text-align: center;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0;
        margin-top: 5px;
    }
}