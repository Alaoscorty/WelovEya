@extends('layouts.application')

@section('title', 'Artistes')

@section('content')

<div className="ml-56 p-8">
          <div className="mb-6">
            <h1 className="text-2xl font-bold text-white mb-1">Gestion des revendeurs</h1>
            <p className="text-sm text-gray-400">Gérez vos partenaires et leurs performances</p>
          </div>

          <div className="grid grid-cols-3 gap-6 mb-8">
            <div className="bg-[#0d1b2f] border border-gray-800 rounded-xl p-5">
              <div className="flex items-center justify-between mb-2">
                <span className="text-sm text-gray-400">Total revendeurs</span>
                <i className="fas fa-users text-2xl text-orange-500"></i>
              </div>
              <div className="text-3xl font-bold text-white">156</div>
            </div>
            <div className="bg-[#0d1b2f] border border-gray-800 rounded-xl p-5">
              <div className="flex items-center justify-between mb-2">
                <span className="text-sm text-gray-400">Actifs ce mois</span>
                <i className="fas fa-chart-line text-2xl text-orange-500"></i>
              </div>
              <div className="text-3xl font-bold text-white">134</div>
            </div>
            <div className="bg-[#0d1b2f] border border-gray-800 rounded-xl p-5">
              <div className="flex items-center justify-between mb-2">
                <span className="text-sm text-gray-400">Commission Moyenne</span>
                <i className="fas fa-percentage text-2xl text-orange-500"></i>
              </div>
              <div className="text-3xl font-bold text-white">14.3 %</div>
            </div>
          </div>
          <div className="bg-[#0d1b2f] border border-gray-800 rounded-xl overflow-hidden">
            <div className="flex items-center justify-between p-4 border-b border-gray-800">
              <div className="relative flex-1 max-w-md">
                <i className="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
                <input 
                  type="text" 
                  placeholder="Rechercher un revendeur ..." 
                  className="w-full bg-[#0a1628] border border-gray-700 rounded-lg py-2 pl-10 pr-3 text-sm text-gray-300 placeholder-gray-500 focus:outline-none focus:border-blue-500"
                />
              </div>
              <button href="{{ url('/ajouterrevendeur') }}" className="ml-4 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                + Ajouter revendeur
              </button>
              <button className="ml-2 text-gray-400 hover:text-white px-3 py-2 text-sm">
                <i className="fas fa-file-pdf mr-1"></i> PDF (156)
              </button>
            </div>
            <div className="overflow-x-auto">
              <table className="w-full">
                <thead>
                  <tr className="border-b border-gray-800 text-xs text-gray-400">
                    <th className="text-left p-4 font-medium">
                      <input type="checkbox" className="rounded border-gray-600" />
                    </th>
                    <th className="text-left p-4 font-medium">
                      <i className="fas fa-user mr-2"></i>Nom
                    </th>
                    <th className="text-left p-4 font-medium">
                      <i className="fas fa-ticket-alt mr-2"></i>Tickets Vendus
                    </th>
                    <th className="text-left p-4 font-medium">
                      <i className="fas fa-percentage mr-2"></i>Commission
                    </th>
                    <th className="text-left p-4 font-medium">
                      <i className="fas fa-signal mr-2"></i>Statut
                    </th>
                    <th className="text-left p-4 font-medium">
                      <i className="fas fa-calendar mr-2"></i>Revenue générale
                    </th>
                    <th className="text-left p-4 font-medium">
                      <i className="fas fa-chart-bar mr-2"></i>Ventes directes
                    </th>
                    <th className="text-left p-4 font-medium">
                      <i className="fas fa-chart-line mr-2"></i>Ventes moyennes
                    </th>
                    <th className="text-left p-4 font-medium">
                      <i className="fas fa-exclamation-triangle mr-2"></i>Non réglé
                    </th>
                    <th className="text-left p-4 font-medium">
                      <i className="fas fa-chart-pie mr-2"></i>Performance
                    </th>
                    <th className="text-left p-4 font-medium"></th>
                  </tr>
                </thead>
                <tbody>
                  {revendeurs.map((rev, index) => (
                    <tr key={rev.id} className="border-b border-gray-800 hover:bg-[#0a1628] transition-colors">
                      <td className="p-4">
                        <input type="checkbox" className="rounded border-gray-600" />
                      </td>
                      <td className="p-4">
                        <div className="flex items-center gap-3">
                          <div className="w-8 h-8 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-full flex items-center justify-center text-sm font-semibold">
                            {rev.nom.charAt(0)}
                          </div>
                          <div>
                            <div className="text-sm font-medium text-white">{rev.nom}</div>
                            <div className="text-xs text-gray-400">{rev.email}</div>
                          </div>
                        </div>
                      </td>
                      <td className="p-4">
                        <div className="text-sm text-gray-300">{rev.phone}</div>
                        <div className="text-xs text-gray-500">{rev.tickets}</div>
                      </td>
                      <td className="p-4">
                        <span className="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-orange-500/20 text-orange-400 border border-orange-500/30">
                          {rev.commission}
                        </span>
                      </td>
                      <td className="p-4">
                        <span className={inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium ${getStatutClass(rev.statut)}}>
                          {rev.statut}
                        </span>
                      </td>
                      <td className="p-4">
                        <div className="text-sm text-gray-300">{rev.nonRegle}</div>
                      </td>
                      <td className="p-4">
                        <div className="text-sm text-gray-300">{rev.date}</div>
                      </td>
                      <td className="p-4">
                        <div className="text-sm text-gray-300">{rev.ventesDirectes}</div>
                      </td>
                      <td className="p-4">
                        <div className="text-sm text-gray-300">{rev.ventesMoyennes}</div>
                      </td>
                      <td className="p-4">
                        <div className="text-sm text-gray-300">{rev.performance}%</div>
                      </td>
                      <td className="p-4">
                        <div className="flex items-center gap-2">
                          <button className="p-1.5 hover:bg-gray-700 rounded transition-colors">
                            <i className="fas fa-eye text-gray-400"></i>
                          </button>
                          <button className="p-1.5 hover:bg-gray-700 rounded transition-colors">
                            <i className="fas fa-edit text-gray-400"></i>
                          </button>
                          <button className="p-1.5 hover:bg-gray-700 rounded transition-colors">
                            <i className="fas fa-trash text-gray-400"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>

            <div className="flex items-center justify-between p-4 border-t border-gray-800">
              <div className="text-sm text-gray-400">
                1 - 10 of 156
              </div>
              <div className="flex items-center gap-3">
                <span className="text-sm text-gray-400">Items par page:</span>
                <select 
                  value={itemsPerPage}
                  onChange={(e) => setItemsPerPage(Number(e.target.value))}
                  className="bg-[#0a1628] border border-gray-700 rounded-lg px-3 py-1.5 text-sm text-gray-300 focus:outline-none focus:border-blue-500"
                >
                  <option value={10}>10</option>
                  <option value={20}>20</option>
                  <option value={50}>50</option>
                </select>
                <div className="flex items-center gap-1 ml-4">
                  <button className="p-1.5 hover:bg-gray-700 rounded transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <i className="fas fa-chevron-left text-gray-400"></i>
                  </button>
                  <button className="p-1.5 hover:bg-gray-700 rounded transition-colors">
                    <i className="fas fa-chevron-right text-gray-400"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection

    @push('scripts')
@endpush
