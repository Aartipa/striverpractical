<?php

namespace App\Livewire;

use Livewire\Component;

class InvoiceDashboard extends Component
{
    public $invoices = [];
    public $activeTab = 'all';
    public $dropdownOpen = [];

    public function mount()
    {
        // Hardcoded Invoice Data
        $this->invoices = [
            ['amount' => 10, 'number' => 'B7F8...', 'customer' => 'michael@dundermifflin.com', 'status' => 'draft', 'created' => 'Jun 7, 3:36 PM'],
            ['amount' => 8, 'number' => 'ECF1...', 'customer' => 'alexander@stripe.com', 'status' => 'paid', 'created' => 'Apr 29, 6:42 PM'],
            ['amount' => 15, 'number' => 'FA8B...', 'customer' => 'kevin@dundermifflin.com', 'status' => 'outstanding', 'created' => 'May 10, 5:20 PM'],
            ['amount' => 20, 'number' => 'C419...', 'customer' => 'pam@dundermifflin.com', 'status' => 'paid', 'created' => 'May 12, 7:10 PM'],
            ['amount' => 12, 'number' => 'FD10...', 'customer' => 'jim@dundermifflin.com', 'status' => 'draft', 'created' => 'May 15, 4:30 PM'],
        ];

        // Initialize dropdown state for each row
        $this->dropdownOpen = array_fill(0, count($this->invoices), false);
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function toggleDropdown($index)
    {
        $this->dropdownOpen[$index] = !$this->dropdownOpen[$index];
    }

    public function render()
    {
        $filteredInvoices = $this->activeTab === 'all'
            ? $this->invoices
            : array_filter($this->invoices, fn($invoice) => $invoice['status'] === $this->activeTab);

        return view('livewire.invoice-dashboard', [
            'filteredInvoices' => $filteredInvoices
        ])->layout('layouts.app'); // Ensure the layout exists
    }
}