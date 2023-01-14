<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Invoice $invoice)
    {
        return userCanView("invoiceandsales.view");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function draft(User $user)
    {
        return userCanView("invoiceandsales.draft_invoice");
    }

    public function complete(User $user)
    {
        return userCanView("invoiceandsales.complete_invoice");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Invoice $invoice)
    {
        if($invoice->sub_total < 0) return false;

        if($invoice->status === "APPROVED") return false;

        if($invoice->status === "PENDING-APPROVAL") return false;

        if($invoice->status === "DELETED") return false;

        return userCanView("invoiceandsales.edit");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Invoice $invoice)
    {
        return userCanView("invoiceandsales.destroy");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Invoice $invoice)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Invoice $invoice)
    {
        //
    }


    public function print(User $user, Invoice $invoice)
    {
        if($invoice->status === "APPROVED") return false;

        if($invoice->status === "PENDING-APPROVAL") return false;

        if($invoice->status === "DELETED") return false;

        return userCanView("invoiceandsales.pos_print");
    }


    public function approve(User $user, Invoice $invoice)
    {
        if($invoice->status !== "PENDING-APPROVAL") return false;

        return userCanView("invoiceandsales.approve");
    }

    public function decline(User $user, Invoice $invoice)
    {
        if($invoice->status !== "PENDING-APPROVAL") return false;

        return userCanView("invoiceandsales.decline");
    }

    public function pay(User $user, Invoice $invoice)
    {
        if($invoice->status !== "APPROVED") return false;

        return userCanView("invoiceandsales.complete_invoice_no_edit");
    }


    public function draftInvoice(User $user, Invoice $invoice)
    {

        if($invoice->status === "DRAFT") return false;

        if($invoice->status === "COMPLETE") return false;

        return userCanView("invoiceandsales.send_draft_invoice");
    }

}
