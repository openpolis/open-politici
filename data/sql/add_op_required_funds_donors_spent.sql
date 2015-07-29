alter table op_required_funds add column donors int(10) after id;
alter table op_required_funds add column spent int(10) after raised;
