<div>
    <button class="btn btn-primary" ng-click="addService()">添加</button>
</div>
<div class="dataTable">
    <table class="table">
        <thead>
            <tr>
                <th>序号</th>
                <th ng-repeat="item in cat">标题</th>
            </tr>
        </thead>
        <tbody class="table-hover">
            <tr ng-repeat="item in list">
                <td>{{$index + 1}}</td>
                <td>{{item.title}}</td>
                <td>蛋白质项目</td>
                <td>{{item.createTime | date:'yyyy-MM-dd hh:ss'}}</td>
                <td>
                    <a href="#">编辑</a>
                    <a href="#" ng-click="deleteService(item.id)">删除</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
