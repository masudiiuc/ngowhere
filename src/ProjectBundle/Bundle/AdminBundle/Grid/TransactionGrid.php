<?php

namespace ProjectBundle\Bundle\AdminBundle\Grid;

use Kitpages\DataGridBundle\Model\GridConfig;
use Kitpages\DataGridBundle\Model\Field;

class TransactionGrid
{
    public static function getGridConfig($transactionRepo, $userRole)
    {
        $gridConfig = new GridConfig();

        $gridConfig->setCountFieldName('item.id');

        $gridConfig->addField(new Field('item.payzaDate', array('label' => 'Payza Date/Time', 'formatValueCallback' => function ($value, $item) {
            return $value . ' ' . $item['payzaTime'];
        })));

        $gridConfig->addField(new Field('item.senderName', array('label' => 'Sender Name/Email', 'autoEscape' => false, 'formatValueCallback' => function ($value, $item) {
            return $value . '<br/>' . $item['username'];
        })));

        $gridConfig->addField(new Field('item.payzaReferenceNumber', array('label' => 'Payza Reference Number')));

        if ($userRole == 'operator-support'){

            $gridConfig->addField(new Field('item.status', array('label' => 'Status', 'formatValueCallback' => function($value){
                return ucfirst( str_replace('-', ' ' , $value) );
            })));
        }else{

            $gridConfig->addField(new Field('item.status', array('label' => 'Status', 'autoEscape' => false, 'formatValueCallback' => function ($value, $item) {

                $statusList = array(
                    'created'           => 'Created',
                    'approved-by-fraud' => 'Approved by fraud',
                    'on-hold-by-fraud'  => 'On hold by fraud',
                    'exported'          => 'Exported',
                    'reversed'          => 'Reversed',
                    'returned'          => 'Returned'
                );

                $str = '';
                $disabled = '';

                foreach ($statusList as $k => $v) {
                    $selected = ($item['status'] == $k) ? 'selected ="selected"' : '';
                    $str .= "<option value='{$k}' {$selected}>{$v}</option>";
                }

                if ($item['status'] == 'reversed' || $item['status'] == 'returned') {
                    $disabled = 'disabled = "disabled"';
                }

                $output = <<<HTML
    <div id="item_{$item['id']}">
        <select data-id="{$item['id']}" data-status="{$item['status']}" class="input-medium change-status" style="font-size: 12px; margin-top: 10px; height: 25px;" {$disabled}>
             <option value="">--</option>
             {$str}
        </select>
    </div>
HTML;

                return $output;

            })));
        }

        $gridConfig->addField(new Field('item.amount', array('label' => 'Amount', 'sortable' => true, 'formatValueCallback' => function ($value, $item) {
            return $item['amount'] . ' ' . $item['currency'];
        })));

        $gridConfig->addField(new Field('item.onBehalf', array('label' => 'On Behalf Of', 'sortable' => true)));

        $gridConfig->addField(new Field('item.exactAmount', array('label' => 'Exact Amount', 'sortable' => true, 'formatValueCallback' => function ($value, $item) {
            return $item['exactAmount'] . ' ' . $item['currency'];
        })));

        $gridConfig->addField(new Field('item.transactionFee', array('label' => 'Fee', 'sortable' => true)));
        $gridConfig->addField(new Field('item.exactBdtAmount', array('label' => 'Exact Received Amount (BDT)', 'sortable' => true)));
        $gridConfig->addField(new Field('item.recipientName', array('label' => 'Recipient Name', 'sortable' => true)));
        $gridConfig->addField(new Field('item.recipientPhoneNumber', array('label' => 'Recipient Mobile', 'sortable' => true)));
        $gridConfig->addField(new Field('item.recipientEmail', array('label' => 'Recipient Email', 'sortable' => true)));

        $gridConfig->addField(new Field('item.recipientAccountNumber', array('label' => 'Bank Account Number', 'sortable' => true, 'formatValueCallback' => function ($number) {

            if (strlen($number) > 5) {
                $maskCharacter = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
                $maskString = substr($number, 2, strlen($number) - 4);
                $maskSub = substr($maskCharacter, 0, strlen($maskString));
                return str_replace($maskString, $maskSub, $number);
            } else {
                return $number;
            }

        })));

        $gridConfig->addField(new Field('item.id', array('label' => 'Bank', 'formatValueCallback' => function ($value) use ($transactionRepo) {
            return $transactionRepo->getTransactionBank($value);
        })));

        $gridConfig->addField(new Field('item.id', array('label' => 'District', 'formatValueCallback' => function ($value) use ($transactionRepo) {
            return $transactionRepo->getTransactionDistrict($value);
        })));

        $gridConfig->addField(new Field('item.id', array('label' => 'Branch', 'formatValueCallback' => function ($value) use ($transactionRepo) {
            return $transactionRepo->getTransactionBranch($value);
        })));

        $gridConfig->addField(new Field('item.id', array('label' => 'Sent Payza Report Date', 'formatValueCallback' => function ($value, $item) use ($transactionRepo) {
            return ($item['report']) ? $transactionRepo->getTransactionReportDate($item['report']) : '-';
        })));

        $gridConfig->addField(new Field('item.payzaNote', array('label' => 'Payza Note')));
        $gridConfig->addField(new Field('item.transactionId', array('label' => 'Transaction Number')));
        $gridConfig->addField(new Field('item.senderIp', array('label' => 'Client IP', 'sortable' => true)));

        // Extra fields
        $gridConfig->addField(new Field('item.senderCountry', array('label' => 'Sender Country', 'sortable' => true)));
        $gridConfig->addField(new Field('item.currency', array('label' => 'Currency', 'sortable' => true)));
        $gridConfig->addField(new Field('item.timestamp', array('label' => 'Date/Time', 'sortable' => true)));
        $gridConfig->addField(new Field('item.bdtAmount', array('label' => 'Received Amount (BDT)', 'sortable' => true)));
        $gridConfig->addField(new Field('item.payzaTransactionState', array('label' => 'Payza Transaction Status')));
        $gridConfig->addField(new Field('item.payzaTransactionType', array('label' => 'Payza Transaction Type')));

        if ($userRole == 'operator-admin' || $userRole == 'operator-security' || $userRole == 'super-admin') {
            $gridConfig->addField(new Field('item.payzaGrossAmount', array('label' => 'Payza Gross Amount')));
            $gridConfig->addField(new Field('item.payzaFeesAmount', array('label' => 'Payza Fees Amount')));
            $gridConfig->addField(new Field('item.payzaNetAmount', array('label' => 'Payza Net Amount')));
            $gridConfig->addField(new Field('item.payzaSubscriptionPinNumber', array('label' => 'Payza Subscription Pin Number')));
        }

        return $gridConfig;
    }
}