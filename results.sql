SELECT account.name AS 'acname', currency.name AS 'curname', pay.account_id AS 'acid', exp.currency_id AS 'curid', SUM( pay.amount ) AS 'paysum'
FROM (((pay INNER JOIN exp ON pay.exp_id = exp.id) 
INNER JOIN account ON account.id = pay.account_id) INNER JOIN currency ON exp.currency_id = currency.id)
GROUP BY account.name, currency.name, pay.account_id, exp.currency_id
WHERE CONCAT(pay.account_id,".",exp.currency_id) NOT IN (SELECT CONCAT(inc.account_id,".",inc.currency_id) FROM inc GROUP BY inc.account_id, inc.currency_id )

SELECT account.name AS 'acname', currency.name AS 'curname', inc.account_id AS 'acid', inc.currency_id AS 'curid', SUM( inc.amount ) AS 'incsum', ifnull( tmpTab.paysum, 0 ) AS 'paysum'
FROM (((account INNER JOIN inc ON account.id = inc.account_id)
INNER JOIN currency ON inc.currency_id = currency.id)
LEFT OUTER JOIN 
(SELECT pay.account_id AS 'acid', exp.currency_id AS 'curid', SUM( pay.amount ) AS 'paysum'
FROM pay INNER JOIN exp ON pay.exp_id = exp.id GROUP BY pay.account_id, exp.currency_id)
 AS tmpTab ON ( tmpTab.acid = inc.account_id AND tmpTab.curid = inc.currency_id ))
GROUP BY account.name, currency.name, inc.account_id, inc.currency_id